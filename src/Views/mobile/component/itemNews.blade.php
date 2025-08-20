<div class="box-cont">
    <a class="img card-image block overflow-hidden group rounded-[15px]" href="{{url('slugweb',['slug'=>$news->slug])}}" title="{{$news['name'.$lang]}}">
        <img class="w-full rounded-[10px] transition-all group-hover:scale-[1.1]" onerror="this.src='{{thumbs('thumbs/'.config('type.news.'.$news['type'].'.images.photo.thumb1').'/assets/images/noimage.png')}}';" src="{{assets_photo('news',config('type.news.'.$news['type'].'.images.photo.thumb1'),$news->photo,'thumbs')}}" alt="{{$news['name'.$lang]}}">
    </a>
    <div class="tttt">
        <h3><a class="ten text-split text-decoration-none" href="{{url('slugweb',['slug'=>$news->slug])}}" title="{{$news['name'.$lang]}}">{{$news['name'.$lang]}}</a></h3> 
        {!! $slot !!}
    </div>
</div>