@extends('layouts.app')
@section('title', 'BookEvent')

{{-- @include('layouts.headers.pagination') --}}

@section('content') 
    @include('layouts.headers.eventsCard')

    <div class="container-fluid mt--7">
            {{-- <div class="col-xl-8 mb-5 mb-xl-0"> --}}
            <div class="col-xl-12 mb-5">
                <div class="card shadow " >
                        <div class="card-header ">
                            {{-- <div class="row align-items-center"> --}}
                                <div class="row">
                                
                                    <div class="col-xs-12 mb-3">
                                        <h1 class="">Select Packages<br> </h1>
                                    </div>
                                    <div class="col-xs-2">
                                        {{-- <p>for {{ $client[0]->client_name }}</p> --}}
                                    </div>
                            </div>
                            <div class="row">
                                    <div class="col-md-12">
                                        @if(session()->has('success'))
                                            <br>
                                            <div class="alert alert-success" role="alert">
                                                <button type="button" data-dismiss="alert" class="close"><span aria-hidden="true">x</span></button>
                                                {{ session()->get('success') }}<br>
                                            </div>
                                        @endif
                                        @if(session()->has('error'))
                                            <br>
                                            <div class="alert alert-danger" role="alert">
                                                <button type="button" data-dismiss="alert" class="close"><span aria-hidden="true">x</span></button>
                                                {{ session()->get('error') }}<br>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                {{-- {!! Form::open('action' => ['BookEventController@store', 'method' => 'POST', 'id' => 'bookevent']) !!} --}}
                                {!! Form::open(['action' => 'BookEventController@store', 'method' => 'POST']) !!}
                                {{-- <form action = "BookEventController@store" method = "POST"> --}}
                                {{-- {{ csrf_field() }} --}}
                        </div>
                        <div class="card-body border-0">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
<script>
    function toggle(x){
        if(x=="Others"){
            var test=document.getElementById('test');
                test.style.display="block";
        }
    }
</script>
{{-- <script>
    $(document).ready(function(){
        var sel = document.getElementById("location");
        var text = document.getElementById("eventvenue");
        var text1 = document.getElementById("eventvenueL");
        var text2 = document.getElementById("eventvenueA");
        text.hidden = (sel.value != "4");
        text1.hidden = (sel.value != "4");
        text2.hidden = (sel.value != "4");
        text1.disabled = (sel.value != "4");
        text2.disabled = (sel.value != "4");
        sel.disabled = (text.value != '');

        var start = document.getElementById('eventStartDate');
        var end = document.getElementById('eventEndDate');
        
        start.onchange = function(){
            end.value = start.value; 
        };
        // start.onkeydown = function(){
        //     end.value = start.value; 
        // };
        

        sel.onchange = function(e) {
            text.hidden = (sel.value != "4");
            text1.hidden = (sel.value != "4");
            text2.hidden = (sel.value != "4");
            text.disabled = (sel.value != "4");
            text1.disabled = (sel.value != "4");
            text2.disabled = (sel.value != "4");
        };

        text.oninput = function(e){
            sel.disabled = (text.value != ''); 
        }
    });
    
</script> --}}

@endpush