@extends('base')

@section('title', 'Tech Kontra Vírus | Adj hozzá ötletet!')

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
            margin: 0 15px 15px 0;
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
    </style>
@endsection

@section('scripts')
    <script src="{{ mix('js/new-idea.js') }}"></script>
@endsection

@section('content')
    <div id="new-idea" class="container">
        <h3 class="mt-4 mb-5 text-center">Adj hozzá ötletet!</h3>

        <form-wizard submit-url="/nowy-pomysl">
            <template v-slot:csrf>@csrf</template>
            <template v-slot:tabs>
                <tab name="1. lépés" info="Leírás" :selected="true">
                    <div id="form-step-1" >
                        <div class="form-group limit-width">
                            <label for="title"><b>Elnevezés (max. 150 karakter)</b></label>
                            <input type="text" name="title" class="form-control" v-validate="'required|max:150'"
                                   data-vv-scope="step1">
                            <p class="text-danger" v-show="errors.has('step1.title')">
                                @{{ errors.first('step1.title') }}
                            </p>
                        </div>
                        <div class="form-group limit-width">
                            <label for="description"><b>Rövid leírás (max. 500 karakter)</b></label><br/>
                            <i>Írd le az elképzelésed 2-3 mondatban.</i><br/><br/>
                            <textarea rows="5" name="description" class="form-control" v-validate="'required|max:500'"
                                      data-vv-scope="step1"></textarea>
                            <p class="text-danger" v-show="errors.has('step1.title') || errors.has('step1.description')">
                                @{{ errors.first('step1.description') }}
                            </p>
                        </div>
                        <div class="form-group limit-width">
                            <label for="categories"><b>Kategorie</b></label><br/>
                            <i>Zaznacz jakich tematów dotyczy pomysł.</i><br/><br/>
                            <div>
                                <b-button-toolbar class="d-flex">
                                    @foreach ($categories as $category)
                                        <b-button size="sm" @click="toggleCategory({{$category->id}})"
                                                  class="btn-category-{{ $category->id }}"
                                                  :class="categories.includes(String({{$category->id}})) ? 'pressed' : ''">
                                            {{ $category->name }}
                                        </b-button>
                                    @endforeach
                                </b-button-toolbar>
                            </div>
                        </div>
                        <input type="hidden" name="categories" ref="categories" value=""/>
                    </div>
                </tab>
                <tab name="2. lépés" info="Mit?">
                    <div id="form-step-2">
                        <div class="form-group limit-width">
                            <label for="problem"><b>Milyen problémára vagy szükségletre nyújt megoldást a javasolt ötleted? (max. 1000 karakter)</b></label><br/>
                            <i>Írd körül a problémát. Vedd figyelembe, hogy a körülmények akár napról napra változhatnak. Lehetsz vázlatos, és gondolj át minél több nézőpontot.</i><br/><br/>
                            <textarea name="problem" class="form-control" rows="7" v-validate="'required|max:1000'"
                                      data-vv-scope="step2"></textarea>
                            <p class="text-danger" v-show="errors.has('step2.problem')">
                                @{{ errors.first('step2.problem') }}
                            </p>
                        </div>
                    </div>
                </tab>
                <tab name="3. lépés" info="Ki?">
                    <div id="form-step-3">
                        <div class="form-group limit-width">
                            <label for="recipients"><b>Kit érint a probléma? Ki fogja az eszközt használni? (max. 1000 karakter)</b></label><br/>
                            <i>Írd le, kik érintettek a helyzetben. Milyen csoportok vagy intézmények segíthetnek a munkában?</i><br/><br/>
                            <textarea name="recipients" class="form-control" rows="7" v-validate="'required|max:1000'"
                                      data-vv-scope="step3"></textarea>
                            <p class="text-danger" v-show="errors.has('step3.recipients')">
                                @{{ errors.first('step3.recipients') }}
                            </p>
                        </div>
                    </div>
                </tab>
                <tab name="4. lépés" info="Hogyan?">
                    <div id="form-step-4">
                        <div class="form-group limit-width">
                            <label for="solution"><b>Mi a te javaslatod a leírt problémára? (max. 1000 karakter)</b></label><br/>
                            <i>Van a fejedben digitális technológián alapuló megoldási javaslat? Láttál már hasonlót?</i><br/><br/>
                            <textarea name="solution" class="form-control" rows="7" v-validate="'required|max:1000'"
                                      data-vv-scope="step4"></textarea>
                            <p class="text-danger" v-show="errors.has('step4.solution')">
                                @{{ errors.first('step4.solution') }}
                            </p>
                        </div>
                    </div>
                </tab>
            </template>
        </form-wizard>
    </div>
@endsection
