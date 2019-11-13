<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Argon Dashboard') }}</title>
        <!-- Favicon -->
        <link href="{{ asset('argon') }}/img/brand/cvj.png" rel="icon" type="image/png">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
        <!-- Icons -->
        <link href="{{ asset('argon') }}/vendor/nucleo/css/nucleo.css" rel="stylesheet">
        <link href="{{ asset('argon') }}/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
        <!-- Argon CSS -->
        <link type="text/css" href="{{ asset('argon') }}/css/argon.css?v=1.0.0" rel="stylesheet">


        <!------>
        <script type="text/javascript" src="/bower_components/jquery/jquery.min.js"></script>
        <script type="text/javascript" src="/bower_components/moment/min/moment.min.js"></script>
        <script type="text/javascript" src="/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
        <link rel="stylesheet" href="/bower_components/bootstrap/dist/css/bootstrap.min.css" />
        <link rel="stylesheet" href=". /resources/css/bootstrap-datetimepicker.min.css" />

        <script type="text/javascript" src=". /resources/js/jquery.min.js"></script>
        <script type="text/javascript" src=". /resources/js/moment.min.js"></script>
        <script type="text/javascript" src=". /resources/js/bootstrap.min.js"></script>
        <script type="text/javascript" src=". /resources/js/bootstrap-datetimepicker.*js"></script>
        {{--  --}}
        
    <link rel="stylesheet" type="text/css" media="screen"
     href="http://tarruda.github.com/bootstrap-datetimepicker/assets/css/bootstrap-datetimepicker.min.css">


        <script type="text/javascript">
            function Pager(tableName, itemsPerPage) {
                this.tableName = tableName;
                this.itemsPerPage = itemsPerPage;
                this.currentPage = 1;
                this.pages = 0;
                this.inited = false;
                this.showRecords = function(from, to) {
                    var rows = document.getElementById(tableName).rows;
                    // i starts from 1 to skip table header row
                    for (var i = 1; i < rows.length; i++) {
                        if (i < from || i > to)
                            rows[i].style.display = 'none';
                        else
                            rows[i].style.display = '';
                    }
                }
                this.showPage = function(pageNumber) {
                    if (!this.inited) {
                        alert("not inited");
                        return;
                    }
                    var oldPageAnchor = document.getElementById('pg' + this.currentPage);
                    oldPageAnchor.className = 'pg-normal';
                    this.currentPage = pageNumber;
                    var newPageAnchor = document.getElementById('pg' + this.currentPage);
                    newPageAnchor.className = 'pg-selected';
                    var from = (pageNumber - 1) * itemsPerPage + 1;
                    var to = from + itemsPerPage - 1;
                    this.showRecords(from, to);
                }
                this.prev = function() {
                    if (this.currentPage > 1)
                        this.showPage(this.currentPage - 1);
                }
                this.next = function() {
                    if (this.currentPage < this.pages) {
                        this.showPage(this.currentPage + 1);
                    }
                }
                this.init = function() {
                    var rows = document.getElementById(tableName).rows;
                    var records = (rows.length - 1);
                    this.pages = Math.ceil(records / itemsPerPage);
                    this.inited = true;
                }
                this.showPageNav = function(pagerName, positionId) {
                    if (!this.inited) {
                        alert("not inited");
                        return;
                    }
                    var element = document.getElementById(positionId);
                    var pagerHtml = '<span class="btn btn-sm btn-primary" style="float:left; background-color:#DCDCDC; font-size:90%; color:gray" onclick="' + pagerName + '.prev();" class=""><b>&nbsp; « Prev &nbsp;</b></span> ';
                    for (var page = 1; page <= this.pages; page++)
                        pagerHtml += '<span style="font-size:90%;" id="pg' + page + '" class="pg-normal" onclick="' + pagerName + ' .showPage(' + page + ');"> <b>&emsp;' + page + '</b></span> ';
                    pagerHtml += '<span class="btn btn-sm btn-primary" style="float:right; background-color:#DCDCDC; font-size:90%; color:gray" onclick="' + pagerName + '.next();" class=""><b>&nbsp; Next » &nbsp;</b></span>';
                    element.innerHTML = pagerHtml;
                }
            }
    </script>
    <script>
        function searchTable() {
            // Declare variables 
            var input, filter, table, tr, td, i;
            input = document.getElementById("myInput");

                filter = input.value.toUpperCase();
                table = document.getElementById("myTable");
                tr = table.getElementsByTagName("tr");
                // tr = table.getElementsByClassName("mamamo");
                th = table.getElementsByTagName("th");
    
                // Loop through all table rows, and hide those who don't match the search query
                for (i = 1; i < tr.length; i++) {
                    tr[i].style.display = "none";
                    for (var j = 0; j <= th.length; j++) {
                        td = tr[i].getElementsByTagName("td")[j];
                        if (td) {
                            if (td.innerHTML.toUpperCase().indexOf(filter.toUpperCase()) > -1) {
                                tr[i].style.display = "";
                                break;
                            }
                        }
                    }
                }
                //document.getElementById("myInput").value = "";
        }
    </script>


    <script type="text/javascript">
        $(function() {
          $('#datetimepicker1').datetimepicker({
            language: 'pt-EN'
          });
        });
      </script>

    <script type="text/javascript">
        $(function () {
            $('#datetimepicker1').datetimepicker();
        });
    </script>


{{-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style type="text/css">
    body {
        background: #e2eaef;
        font-family: "Open Sans", sans-serif;
    }
    h2 {
        color: #000;
        font-size: 26px;
        font-weight: 300;
        text-align: center;
        text-transform: uppercase;
        position: relative;
        margin: 30px 0 60px;
    }
    h2::after {
        content: "";
        width: 100px;
        position: absolute;
        margin: 0 auto;
        height: 4px;
        border-radius: 1px;
        background: #7ac400;
        left: 0;
        right: 0;
        bottom: -20px;
    }
    .carousel {
        margin: 50px auto;
        padding: 0 70px;
    }
    .carousel .item {
        color: #747d89;
        min-height: 325px;
        text-align: center;
        overflow: hidden;
    }
    .carousel .thumb-wrapper {
        padding: 25px 15px;
        background: #fff;
        border-radius: 6px;
        text-align: center;
        position: relative;
        box-shadow: 0 2px 3px rgba(0,0,0,0.2);
    }
    .carousel .item .img-box {
        height: 120px;
        margin-bottom: 20px;
        width: 100%;
        position: relative;
    }
    .carousel .item img {	
        max-width: 100%;
        max-height: 100%;
        display: inline-block;
        position: absolute;
        bottom: 0;
        margin: 0 auto;
        left: 0;
        right: 0;
    }
    .carousel .item h4 {
        font-size: 18px;
    }
    .carousel .item h4, .carousel .item p, .carousel .item ul {
        margin-bottom: 5px;
    }
    .carousel .thumb-content .btn {
        color: #7ac400;
        font-size: 11px;
        text-transform: uppercase;
        font-weight: bold;
        background: none;
        border: 1px solid #7ac400;
        padding: 6px 14px;
        margin-top: 5px;
        line-height: 16px;
        border-radius: 20px;
    }
    .carousel .thumb-content .btn:hover, .carousel .thumb-content .btn:focus {
        color: #fff;
        background: #7ac400;
        box-shadow: none;
    }
    .carousel .thumb-content .btn i {
        font-size: 14px;
        font-weight: bold;
        margin-left: 5px;
    }
    .carousel .carousel-control {
        height: 44px;
        width: 40px;
        background: #7ac400;	
        margin: auto 0;
        border-radius: 4px;
        opacity: 0.8;
    }
    .carousel .carousel-control:hover {
        background: #78bf00;
        opacity: 1;
    }
    .carousel .carousel-control i {
        font-size: 36px;
        position: absolute;
        top: 50%;
        display: inline-block;
        margin: -19px 0 0 0;
        z-index: 5;
        left: 0;
        right: 0;
        color: #fff;
        text-shadow: none;
        font-weight: bold;
    }
    .carousel .item-price {
        font-size: 13px;
        padding: 2px 0;
    }
    .carousel .item-price strike {
        opacity: 0.7;
        margin-right: 5px;
    }
    .carousel .carousel-control.left i {
        margin-left: -2px;
    }
    .carousel .carousel-control.right i {
        margin-right: -4px;
    }
    .carousel .carousel-indicators {
        bottom: -50px;
    }
    .carousel-indicators li, .carousel-indicators li.active {
        width: 10px;
        height: 10px;
        margin: 4px;
        border-radius: 50%;
        border-color: transparent;
    }
    .carousel-indicators li {	
        background: rgba(0, 0, 0, 0.2);
    }
    .carousel-indicators li.active {	
        background: rgba(0, 0, 0, 0.6);
    }
    .carousel .wish-icon {
        position: absolute;
        right: 10px;
        top: 10px;
        z-index: 99;
        cursor: pointer;
        font-size: 16px;
        color: #abb0b8;
    }
    .carousel .wish-icon .fa-heart {
        color: #ff6161;
    }
    .star-rating li {
        padding: 0;
    }
    .star-rating i {
        font-size: 14px;
        color: #ffc000;
    }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $(".wish-icon i").click(function(){
                $(this).toggleClass("fa-heart fa-heart-o");
            });
        });	
    </script>
    
{{-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}

    </head>
    <body class="{{ $class ?? '' }}">
        @auth()
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
                @include('layouts.navbars.sidebar')
        @endauth
        
        <div class="main-content">
            @include('layouts.navbars.navbar')
            @yield('content')
        </div>

        @guest()
            @include('layouts.footers.guest')
        @endguest

        <script src="{{ asset('argon') }}/vendor/jquery/dist/jquery.min.js"></script>
        <script src="{{ asset('argon') }}/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        
        @stack('js')
        
        <!-- Argon JS -->
        <script src="{{ asset('argon') }}/js/argon.js?v=1.0.0"></script>
    </body>
</html>