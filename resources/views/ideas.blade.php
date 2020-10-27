@extends('base')

@section('title', 'Tech Kontra Vírus | Ötletek')

@section('styles')
    <style>
        @foreach ($categories as $category)
        {{-- TODO: Possibly some clean-up here. --}}
        .btn-category-{{ $category->id }} {
            color: {{ $category->text_color }};
            background-color: {{ $category->background_color }};
            border-width: 0;
            border-color: {{ $category->background_color }};
            box-shadow: none !important;
            background-image: none;
            margin: 0 10px 10px 0;
        }
        .btn-category-{{ $category->id }}:active {
            color: {{ $category->text_color }} !important;
            background-color: {{ $category->background_color }} !important;
            border-width: 0;
            background-image: none;
        }
        .btn-category-{{ $category->id }}:hover {
            color: {{ $category->text_color }};
            background-color: {{ $category->background_color }};
            background-image: none;
            border-width: 0;
            filter: brightness(120%);
        }
        .btn-category-{{ $category->id }}:focus {
            color: {{ $category->text_color }};
            background-color: {{ $category->background_color }};
            border-width: 0;
            background-image: none;
        }
        .btn-category-{{ $category->id }}.pressed {
            color: {{ $category->text_color }} !important;
            background-color: {{ $category->background_color }} !important;
            background-image: none;
            box-shadow: 0 0 5px 2px {{ $category->background_color }} !important;
            filter: brightness(120%);
        }
        @endforeach
       .btn-primary.tkw {
            color: white;
            background-color: #59a179;
            border-width: 0;
            border-color: #59a179;
            box-shadow: none !important;
            background-image: none;
            margin: 0 10px 10px 0;
        }
        .btn-primary.tkw:active {
            color: white !important;
            background-color: #59a179 !important;
            border-width: 0;
            background-image: none;
            box-shadow: 0 0 5px 2px #59a179 !important;
            filter: brightness(120%);
        }
        .btn-primary.tkw:hover {
            color: white;
            background-color: #59a179;
            background-image: none;
            border-width: 0;
            filter: brightness(120%);
        }
       .btn-primary.tkw:focus {
            color: white;
            background-color: #59a179;
            border-width: 0;
            background-image: none;
        }
        .btn-primary.tkw.pressed, .btn-primary.tkw.active {
            color: white !important;
            background-color: #59a179 !important;
            background-image: none;
            box-shadow: 0 0 5px 2px #59a179 !important;
            filter: brightness(120%);
        }
    </style>
@endsection

@section('scripts')
    <script src="{{ mix('js/ideas.js') }}"></script>
@endsection

@section('content')
    <div id="ideas" class="container">

        <div class="row flex-column-reverse flex-lg-row mt-4">
            <div class="col-lg-8">
                <div class="slogans">
                    <p>
                        <b>Tegyél a koronavírus ellen! Van egy ötleted</b>, milyen informatikai alkalmazásra lenne szükség? Írd meg!
                        <b>Tudod, hogy lehetne megvalósítani? Javasolj fejlesztési megoldást,</b>,
                        használj fel és fejlessz tovább már létező alkalmazásokat!
                    </p>
                    <p>Az oldal célja összekötni az ötleteket, igényeket és olyanokat, akik képesek ezek megvalósítására.</p>
                    <p class="new-idea-cta">
                        <a class="btn btn-lg btn-primary" href="/nowy-pomysl">Ötlet hozzáadása</a>
                    </p>
                    <p>De előtte azért nézz körül, van-e már hasonló:</p>
                </div>
            </div>

            <div class="col-lg-4">
                <img class="img-tech-brain" src="/img/tech-brain.svg" />
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-lg-8">
                <div class="mb-3">
                    <p class="slogans mb-3"><b>Kategóriák</b></p>
                    <div>
                        <b-button-toolbar class="d-flex">
                            <b-button size="sm" variant="primary" @click="setCategory(null)"
                                      class="tkw" :class="category === null ? 'pressed' : ''">
                                mind
                            </b-button>
                            @foreach ($categories as $category)
                                <b-button size="sm" @click="setCategory({{$category->id}})"
                                          class="btn-category-{{ $category->id }}" :class="category === {{$category->id}} ? 'pressed' : ''">
                                    {{ $category->name }}
                                </b-button>
                            @endforeach
                        </b-button-toolbar>
                    </div>
                </div>

                <div class="mb-3">
                    <p class="slogans mb-3"><b>Rendezés</b></p>
                    <div>
                        <b-button size="sm" variant="primary" @click="setSorting('votes')" class="tkw"
                                  :class="sorting === 'votes' ? 'active' : ''">
                            legjobb értékelés
                        </b-button>
                        <b-button size="sm" variant="primary" @click="setSorting('dates')" class="tkw"
                                  :class="sorting === 'dates' ? 'active' : ''">
                            legújabb
                        </b-button>
                    </div>
                </div>

                <div class="ideas" ref="ideas">
                    @foreach($ideas as $idea)
                        {{-- Skip hidden ideas. --}}
                        @if ($idea->is_hidden) @continue @endif
                        <div class="card card-idea" data-date="{{ $idea->created_at }}" data-votes="{{ $idea->plus - $idea->minus }}"
                             v-show="(category === null) || [{{ $idea->getCategoriesString() }}].includes(category)">
                            <div class="card-header">
                                <plus-minus :value-on-load="{{ $idea->plus - $idea->minus }}"
                                            :ajax-url="'/pomysl/{{ $idea->id }}/glos'"
                                            :vote-on-load="{{ $voting_history->getIdeaVote($idea->id) }}">
                                </plus-minus>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div class="who_when">
                                        Hozzáadva ekkor: {{ $idea->getCreatedAtForDisplay() }}
                                    </div>
                                    <a href="/pomysl/{{ $idea->id }}" class="btn btn-secondary btn-sm" role="button">Bővebben</a>
                                </div>
                                <div>
                                    @foreach ($idea->categories as $category)
                                        <b-badge style="color: {{ $category->text_color }};
                                                        background-color: {{ $category->background_color }};
                                                        font-weight: normal; font-size: small;">
                                            {{ $category->name }}
                                        </b-badge>
                                    @endforeach
                                </div>
                                <div class="title"><a href="/pomysl/{{ $idea->id }}">{{ $idea->title }}</a></div>
                                <div>{{ $idea->description }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
            <div class="col-lg-4 pt-5 pt-lg-0">

                <div>
                    <p>
                        <b>Programozó vagy és segítenél?</b> <a href="https://docs.google.com/forms/d/e/1FAIpQLSeep6bUaI0nC-ZelkPjdUdw_kvzAJu2XJc8qpNhAJeIRSyZEA/viewform" target="new">Jelentkezz csapatunkba!</a> Értékeld az ötleteket, csatlakozz a beszélgetéshez és dolgozz az ügyön annak kiötlőjével!
                    </p>
                    <a href="https://k-monitor.hu/tevekenysegek/20200401-code-for-hungary" class="mt-4 mb-4 d-block"><img src="/img/c4hu_logo.png" width="200" height="127" alt="Code 4 Hungary"></a>
                    <p class="mt-4">
                        A <b>Code for Hungary</b> egy aktivistákból és programozókból szerveződő közösség.
                        A <a href="https://codeforall.org">Code for All</a> mozgalom tagjaként magyarországi társadalmi kezdeményezéseknek
                        kívánunk technológiai segítséget nyújtani és ezáltal társadalmilag hasznos alkalmazások,
                        programok létrehozását serkenteni. A Code for Hungary-t a <a href="https://k-monitor.hu"><b>K-Monitor</b></a> koordinálja.
                    </p>
                </div>

            </div>
        </div>
    </div>
@endsection
