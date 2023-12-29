<div class="main-banner header-text">
    <div class="container-fluid">
      <div class="owl-banner owl-carousel">
        @foreach ($slider_posts as $post)
        <div class="item">
          <div class="">
            <img src="{{$post->image}}" alt="{{$post->post_title}}">
          </div>
          <div class="item-content m-0 p-0">
            <div class="main-content">
              <div class="meta-category">
                <span>{{$post->category->name}}</span>
              </div>
              <a href="{{route('front.single', $post->slug)}}"><h4>{{$post->post_title}}</h4></a>
              <ul class="post-info">
                <li><a href="#">{{$post->user->name}}</a></li>
                <li><a href="#">{{$post->created_at->format('M d, Y')}}</a></li>
                <li><a href="#">{{$post->comment?->count()}} Comments</a></li>
              </ul>
            </div>
          </div>
        </div>
        @endforeach
        
      </div>
    </div>
  </div>