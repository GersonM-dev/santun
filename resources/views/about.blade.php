@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="container mx-auto px-4 space-y-16">
            {{-- Our Competitive Advantage Section --}}
            <section>
                @if(isset($aboutContent['our_advantage_title']))
                    <h2 class="text-3xl font-bold mb-4">{{ $aboutContent['our_advantage_title']->title }}</h2>
                @endif
                @if(isset($aboutContent['our_advantage_body']))
                    <div class="prose max-w-none">
                        {!! $aboutContent['our_advantage_body']->content !!}
                    </div>
                @endif
            </section>

            {{-- About Us Section --}}
            <section>
                @if(isset($aboutContent['about_us_title']))
                    <h2 class="text-3xl font-bold mb-4">{{ $aboutContent['about_us_title']->title }}</h2>
                @endif
                @if(isset($aboutContent['about_us_body']))
                    <div class="prose max-w-none">
                        {!! $aboutContent['about_us_body']->content !!}
                    </div>
                @endif
            </section>

            {{-- Quote Section --}}
            <section>
                @if(isset($aboutContent['quote']))
                    <blockquote class="italic border-l-4 border-primary pl-4 text-xl">
                        {!! $aboutContent['quote']->content !!}
                    </blockquote>
                @endif
            </section>

            {{-- Features Section --}}
            <section>
                @if(isset($aboutContent['features_title']))
                    <h2 class="text-3xl font-bold mb-4">{{ $aboutContent['features_title']->title }}</h2>
                @endif
                @if(isset($aboutContent['features_body']))
                    <div class="prose max-w-none">
                        {!! $aboutContent['features_body']->content !!}
                    </div>
                @endif
            </section>
        </div>
    </div>
@endsection