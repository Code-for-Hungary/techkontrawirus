@extends('base')

@section('title', "Tech kontra vírus | Ötlet #$idea->id")

@section('styles')
@endsection

@section('scripts')
    <script src="{{ mix('js/idea.js') }}"></script>
@endsection

@section('content')
    <div id="idea" class="container">

        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Ötletek</a></li>
            <li class="breadcrumb-item active">Ötlet</li>
        </ol>

        @if ($is_new_idea)
            <b-alert variant="primary" :show="true" :dismissible="true">
                Köszi, hogy küldtél be ötlet javaslatot!
            </b-alert>
        @endif
        @if ($has_new_comment)
            <b-alert variant="primary" :show="true" :dismissible="true">
                Köszi a hozzászólást
            </b-alert>
        @endif

        <div class="card card-idea card-idea-main">
            <div class="card-header">
                <plus-minus :value-on-load="{{ $idea->plus - $idea->minus }}"
                            :ajax-url="'/pomysl/{{ $idea->id }}/glos'"
                            :vote-on-load="{{ $voting_history->getIdeaVote($idea->id) }}"></plus-minus>
            </div>
            <div class="card-body">
                <div class="who_when">
                    Hozzáadva ekkor: {{ $idea->getCreatedAtForDisplay() }}
                </div>
                <div>
                    @foreach ($idea->categories as $category)
                        <b-badge style="color: {{ $category->text_color }};
                                        background-color: {{ $category->background_color }}">
                            {{ $category->name }}
                        </b-badge>
                    @endforeach
                </div>
                <h1 class="title"><a href="/pomysl/{{ $idea->id }}">{{ $idea->title }}</a></h1>

                <div class="description pb-4 mb-4">{{ $idea->description }}</div>

                <div class="mb-4"><b>Hol a probléma/szükséglet?</b><br/>{{ $idea->problem }}</div>
                <div class="mb-4"><b>Kik az érintettek? Ki fogja használni az eszközt?</b><br/>{{ $idea->recipients }}</div>
                <div class="mb-4"><b>Mi a te javaslatod a probléma/szükséglet megoldására?</b><br/>{{ $idea->solution }}</div>
            </div>
        </div>

        <div class="limit-width">
            <p class="mt-5 mb-5">
                Használd a hozzászólásokat az ötlet népszerűsítésére és a másokkal közös fejlesztésre. Ha már megegyezésre jutottatok a részletekről, hozz létre egy csatornát a <a href="https://codeforhungary.slack.com">Code for Hungary slacken</a> [tkv] előtaggal és linkjét írd be a kommentek közé, hogy más is csatlakozhasson!
            </p>

            @if ($idea->comments->isNotEmpty())
                <h4 class="mt-4">Hozzászólások</h4>
            @endif
            @foreach($idea->comments as $comment)
                {{-- Skip hidden comments. --}}
                @if ($comment->is_hidden) @continue @endif
                <div class="card card-idea">
                    <div class="card-header">
                        <plus-minus :value-on-load="{{ $comment->plus - $comment->minus }}"
                                    :ajax-url="'/komentarz/{{ $comment->id }}/glos'"
                                    :vote-on-load="{{ $voting_history->getCommentVote($comment->id) }}"></plus-minus>
                    </div>
                    <div class="card-body">
                        <div class="who_when">Dodano {{ $comment->getCreatedAtForDisplay() }}</div>
                        <div>{{ $comment->content }}</div>
                    </div>
                </div>
            @endforeach

            <h4 class="mt-4">Hozzászólás írása:</h4>
            <form action="/pomysl/{{$idea->id}}/nowy-komentarz" method="post" ref="new-comment" class="mb-2">
                @csrf
                <textarea rows="4" name="content" class="w-100" v-validate="'required|max:500'" data-vv-scope="new-comment"></textarea>
                <p class="text-danger" v-show="errors.has('new-comment.content')">
                    @{{ errors.first('new-comment.content') }}
                </p>
            </form>
            <button class="btn btn-primary" @click="saveComment">Hozzászólás elküldése</button>
        </div>
    </div>
@endsection
