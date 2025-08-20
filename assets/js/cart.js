class Cart {
	constructor(options) {
		this.wrapper = document.querySelector('body');
		this.base_url = options?.url || '';
		this.CountCart = document.querySelector('.count-cart');
		this.init();
	}

	init() {
		window.addEventListener('load', () => {
			this.showPrice();			
			this.showPhoto();

		});

		this.wrapper.addEventListener('click', (e) => {
			if (e.target.closest('.addcart')) {
				this.addCart(e.target.closest('.addcart'));
			} else if (e.target.matches('.quantity-pro-detail span')) {
				this.numberCart(e.target);
			} else if (e.target.matches('.quantity-counter-procart span')) {
				this.numberForm(e.target);
			} else if (e.target.closest('.del-procart')) {
				this.deleteCart(e.target.closest('.del-procart'));
			} else if (e.target.closest('.payments-label')) {
				this.ShowPayments(e.target.closest('.payments-label'));
			} else if (e.target.closest('.properties.active')) {
				this.showPrice();
			}
			if (e.target.closest('.load__photo.active')) {
				this.showPhoto();
			}
		});

		this.wrapper.addEventListener('change', (e) => {
			if (e.target.closest('.select-city-cart')) {
				this.getDistrict(e.target.closest('.select-city-cart'));
			} else if (e.target.matches('.select-district-cart')) {
				this.getWard(e.target.closest('.select-district-cart'));
			}
		});

		// this.wrapper.addEventListener('submit', (e) => {
		// 	if (e.target.matches('.form-cart')) {
		// 		this.submitCart(e);
		// 	}
		// });
	}

	showPrice() {
		if ($('.properties').length) {
			const id_product = this.wrapper.querySelector('.properties.active').getAttribute('data-product');
			const id_properties = this.wrapper.querySelector('.properties.active').getAttribute('data-id');
			var form_data = new FormData();
			form_data.append('id_product', id_product);
			form_data.append('id_properties', id_properties);

			fetch(this.base_url + 'cart/show-price', {
				method: 'POST',
				body: form_data
			})
				.then((response) => response.json())
				.then((result) => {
					// if(result.desc){
					// 	this.wrapper.querySelector('.desc-pro-detail').innerHTML = result.desc;
					// }
					
					this.wrapper.querySelector('.price-new-pro-detail').innerHTML = result.priceNew;
					if(this.wrapper.querySelector('.price-old-pro-detail'))
					this.wrapper.querySelector('.price-old-pro-detail').innerHTML = result.priceOld;
				});
		}
	}
	showPhoto() {
		if ($('.load__photo').length) {

			// const properties = this.wrapper.querySelectorAll('.load__photo.active');
			// const id_product = properties[0].getAttribute('data-product'); 
			// const id_properties = Array.from(properties).map(property => property.getAttribute('data-id')).join(',');

			const id_product = this.wrapper.querySelector('.load__photo.active').getAttribute('data-product');
			const id_properties = this.wrapper.querySelector('.load__photo.active').getAttribute('data-id');
	
			var form_data = new FormData();
			form_data.append('id_product', id_product);
			form_data.append('id_properties', id_properties);
	
			fetch(this.base_url + 'cart/show-photo', {
				method: 'POST',
				body: form_data
			})
			.then((response) => response.text())
			.then((result) => {
				if(result) {
					this.wrapper.querySelector('.kq_photo').innerHTML = result;
					MagicZoom.refresh('Zoom-2');
					NN_FRAMEWORK.Lazys();
					NN_FRAMEWORK.slickPage();
				}
			});
		}
	}
	
	// submitCart(e) {
	// 	e.preventDefault();
	// 	const form = e.target;
	// 	const formData = new FormData(form);
	// 	holdonOpen();
	// 	fetch(this.base_url + 'cart/send-to-cart', {
	// 		method: 'POST',
	// 		body: formData
	// 	})
	// 		.then((response) => response.json())
	// 		.then((result) => {});
	// }

	getDistrict(target) {
		const selectCity = document.querySelector('.select-city-cart');
		const selectDistrict = document.querySelector('.select-district-cart');
		const id = selectCity.value;
		holdonOpen();
		var form_data = new FormData();
		form_data.append('id', id);
		fetch(this.base_url + 'cart/get-district', {
			method: 'POST',
			body: form_data
		})
			.then((response) => response.json())
			.then((result) => {
				if (result.districts) {
					this.populateSelect(result.districts, selectDistrict);
				}
				holdonClose();
			});
	}

	getWard(target) {
		const selectCity = document.querySelector('.select-district-cart');
		const selectDistrict = document.querySelector('.select-ward-cart');
		const id = selectCity.value;
		holdonOpen();
		var form_data = new FormData();
		form_data.append('id', id);
		fetch(this.base_url + 'cart/get-ward', {
			method: 'POST',
			body: form_data
		})
			.then((response) => response.json())
			.then((result) => {
				if (result.wards) {
					this.populateSelect(result.wards, selectDistrict);
				}
				holdonClose();
			});
	}

	addCart(target) {
		const id = parseInt(target.getAttribute('data-id'), 10); // Chuyển đổi id sang số nguyên
		const photo = $(target).parents('.kt__photo').find('.kq_photo1').attr('rel');
		const properties = [];
		this.wrapper.querySelectorAll('.properties.active').forEach((v, k) => {
			properties.push(v.getAttribute('data-id'));
		});

		const action = target.getAttribute('data-action');
		const quantity = parseInt(this.wrapper.querySelector('.qty-pro').value, 10);
		holdonOpen();
		var form_data = new FormData();
		form_data.append('id', id);	
		form_data.append('photo', photo);
		form_data.append('quantity', quantity);
		form_data.append('properties', JSON.stringify(properties));
		form_data.append('csrf_token', TOKEN);

		fetch(this.base_url + 'cart/add-to-cart', {
			method: 'POST',
			body: form_data
		})
			.then((response) => response.json())
			.then((result) => {
				if (action == 'addnow') {
					$('.count-cart').text(result.max);	
					showNotify('Thêm giỏ hàng thành công.', 'Thông báo', 'success');
				} else {
					window.location.href = CART_URL['PAGE_CART'];
				}
				holdonClose();
			});
	}

	deleteCart(target) {
		const parentElement = document.querySelector('.form-cart');
		const rowId = target.getAttribute('data-rowId');
		var form_data = new FormData();
		form_data.append('rowId', rowId);
		holdonOpen();
		fetch(this.base_url + 'cart/delete-to-cart', {
			method: 'POST',
			body: form_data
		})
			.then((response) => response.json())
			.then((result) => {
				$('.count-cart').text(result.max);
				this.wrapper.querySelector('.load-price-sub').innerHTML = result.tempText;
				if(result.max===0) this.wrapper.querySelector('.load-price-ship').innerHTML = 0;
				this.wrapper.querySelector('.load-price-total').innerHTML = result.totalText;
				parentElement.querySelector('.procart-' + rowId)?.remove();
				showNotify('Xóa sản phẩm thành công.', 'Thông báo', 'success');
				holdonClose();
			});
	}

	ShowPayments(target) {
		//const element = target.parentNode;
		const element = target.closest('.payments-cart');
		document.querySelectorAll('.payments-info').forEach((el) => el.classList.remove('active'));
		element.querySelector('.payments-info').classList.add('active');
	}

	numberCart(target) {
		const text = target.innerHTML;
		const num = document.querySelector('.qty-pro').value;
		if (text == '-') {
			const inputElement = document.querySelector('.qty-pro');
			if (num > 1) {
				inputElement.value = parseInt(num, 10) - 1;
			} else {
				inputElement.value = 1;
			}
		} else {
			const inputElement = document.querySelector('.qty-pro');
			inputElement.value = parseInt(num, 10) + 1;
		}
	}

	numberForm(target) {
		const text = target.innerHTML;
		const inputElement = target.parentNode.querySelector('.quantity-counter-procart .quantity-procat');
		const num = inputElement.value ?? 0;
		const rowId = inputElement.getAttribute('data-rowId');
		if (text == '-') {
			if (num > 1) {
				inputElement.value = parseInt(num, 10) - 1;
			} else {
				inputElement.value = 1;
			}
		} else {
			inputElement.value = parseInt(num, 10) + 1;
		}

		var form_data = new FormData();
		form_data.append('quantity', inputElement.value);
		form_data.append('rowId', rowId);

		fetch(this.base_url + 'cart/update-to-number', {
			method: 'POST',
			body: form_data
		})
			.then((response) => response.json())
			.then((result) => {
				if (result.max) {
					this.CountCart.innerHTML = result.max;
					this.wrapper.querySelectorAll('.load-price-new-' + rowId)?.forEach((v, k) => {
						v.innerHTML = result.salePrice;
					});
					this.wrapper.querySelectorAll('.load-price-' + rowId).forEach((v, k) => {
						v.innerHTML = result.regularPrice;
					});
					this.wrapper.querySelector('.load-price-sub').innerHTML = result.tempText;
					this.wrapper.querySelector('.load-price-total').innerHTML = result.totalText;
					showNotify('Câp nhật thành công.', 'Thông báo', 'success');
				} else {
					showNotify('Cập nhật thất bại.', 'Thông báo', 'error');
				}
				holdonClose();
			});
	}

	populateSelect(optionsArray = [], selectElement = '') {
		selectElement.innerHTML = '';
		optionsArray.forEach((optionText) => {
			const optionElement = document.createElement('option');
			optionElement.textContent = optionText.namevi;
			optionElement.value = optionText.id;
			selectElement.appendChild(optionElement);
		});
	}
}
