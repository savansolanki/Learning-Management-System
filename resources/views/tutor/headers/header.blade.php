<div class="parallax overflow-hidden bg-blue-400 page-section third">
    <div class="container parallax-layer" data-opacity="true"
         style="transform: translate3d(0px, 0px, 0px); opacity: 1;">
        <div class="media v-middle">
            <div class="media-left text-center">
                <a href="{{  route('tutor.profile.show',Auth::user()->slug) }} ">
                    <img src="/uploads/profile_image/{{ Auth::user()->avatar }}" alt="people"
                         class="img-circle width-80">
                </a>
            </div>
            <div class="media-body">
                <h1 class="text-white text-display-1 margin-v-0">{{ Auth::user()->name }}</h1>
            </div>
            <div class="media-right">
                <span class="label bg-blue-500">Instructor</span>
            </div>
        </div>
    </div>
</div>