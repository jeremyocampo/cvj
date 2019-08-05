@extends('layouts.app')
@section('title', 'Select Packages')

{{-- <style>
    
    .MultiCarousel { float: left; overflow: hidden; padding: 15px; width: 100%; position:relative; }
    .MultiCarousel{ Height: 250px;}
    .MultiCarousel .MultiCarousel-inner { transition: 1s ease all; float: left; }
    .MultiCarousel .MultiCarousel-inner .item { float: left;}
    .MultiCarousel .MultiCarousel-inner .item > div { text-align: center; padding:10px; margin:10px; background:#f1f1f1; color:#666;}
    .MultiCarousel .leftLst, .MultiCarousel .rightLst { position:absolute; border-radius:50%;top:calc(50% - 20px); }
    .MultiCarousel .leftLst { left:0; }
    .MultiCarousel .rightLst { right:0; }
    
    .MultiCarousel .leftLst.over, .MultiCarousel .rightLst.over { pointer-events: none; background:#ccc; }
    
  </style> --}}

{{-- @include('layouts.headers.pagination') --}}

@section('content') 
    @include('layouts.headers.eventsCard')
{{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script> --}}


<div class = "container-fluid mt--7">
        <div class="card-body">
            <div class="col-xl-8 mb-5 mb-xl-0">
                <div class="card shadow">
                    <div class="card-header boarder-0">
                            @if(session()->has('success'))
                            <div class="alert alert-success" role="alert">
                                <button type="button" data-dismiss="alert" class="close"><span aria-hidden="true">x</span></button>
                                {{ session()->get('success') }}<br>
                            </div>
                            @endif
                            {!! Form::open(['action' => 'SelectPackageController@store', 'method' => 'POST']) !!}
                        <div class="row align-items-center">
                            <div class="col">
                                    <div class= "col-md-12 mb-3"> <h1> Select Packages  <font color="red">*</font></h1>
                            </div>
                            
                            <div class= "col-md-12 mb-3"> 
                            <label class="radio-inline">
                                <input type="radio"  name="selectpackagetype" value = "package1" onchange="toggle(this.value)"> 
                                <label class = "form-label"> Default Packages </label> &nbsp;
                            </label>
                             

                            
                            <label class="radio-inline">
                                <input type="radio" name="selectpackagetype" value="package2" onchange="toggle(this.value)"> 
                                <label class = "form-label"> Customize Packages </label> &nbsp;
                            </label>
                                
                            {{-- <label class="radio-inline">
                                <input type="radio" name="selectpackagetype" value="package3" onchange="toggle(this.value)"> 
                                <label class = "form-label"> Budget Packages </label> &nbsp;
                            </label> --}}
                            
                            <div class="container"  id = "package1accord" style="display:none">
                                    @include('layouts.headers.defaultpackages')

                            </div><br>

                            {{-- MULTI ITEM MultiCarousel --}}
                            {{-- <div class="container"> --}}
                                {{-- <div class="row"> --}}
                                {{-- <div class="MultiCarousel" data-items="1,3,5,6" data-slide="1" id="MultiCarousel"  data-interval="1000">
                                        <div class="MultiCarousel-inner">
                                            <div class="item">
                                                <div class="pad15">
                                                    <p class="lead"><b>Wedding Package A</b></p>
                                                    <p>Min 100 guests </p>
                                                    <p>100,000 - 147,000</p>
                                                    <p> <button type="button" class="btn btn-info" data-toggle="modal" data-target="#edit-modal"> View details </button></p>
                                                </div>
                                            </div>
                                            <div class="item">
                                                <div class="pad15">
                                                    <p class="lead">Wedding Package B</p>
                                                    <p>Min 100 guests </p>
                                                    <p>100,000 - 147,000</p>
                                                    <p> <button type="button" class="btn btn-info" data-toggle="modal" data-target="#edit-modal"> View details </button></p>
                                                </div>
                                            </div>
                                            <div class="item">
                                                <div class="pad15">
                                                    <p class="lead">Wedding Package C</p>
                                                    <p>Min 100 guests </p>
                                                    <p>100,000 - 147,000</p>
                                                    <p> <button type="button" class="btn btn-info" data-toggle="modal" data-target="#edit-modal"> View details </button></p>
                                                </div>
                                            </div>
                                            <div class="item">
                                                <div class="pad15">
                                                    <p class="lead">Wedding Package D</p>
                                                    <p>Min 100 guests </p>
                                                    <p>100,000 - 147,000</p>
                                                    <p> <button type="button" class="btn btn-info" data-toggle="modal" data-target="#edit-modal"> View details </button></p>
                                                </div>
                                            </div>
                                            <div class="item">
                                                <div class="pad15">
                                                    <p class="lead">Birthday Package A</p>
                                                    <p>Min 50 guests </p>
                                                    <p>100,000 - 147,000</p>
                                                    <p> <button type="button" class="btn btn-info" data-toggle="modal" data-target="#edit-modal"> View details </button></p>
                                                </div>
                                            </div>
                                            <div class="item">
                                                <div class="pad15">
                                                    <p class="lead">Birthday Package B</p>
                                                    <p>Min 50 guests </p>
                                                    <p>100,000 - 147,000</p>
                                                    <p> <button type="button" class="btn btn-info" data-toggle="modal" data-target="#edit-modal"> View details </button></p>
                                                </div>
                                            </div>
                                            <div class="item">
                                                <div class="pad15">
                                                    <p class="lead">Birthday Package C</p>
                                                    <p>Min 50 guests </p>
                                                    <p>100,000 - 147,000</p>
                                                    <p> <button type="button" class="btn btn-info" data-toggle="modal" data-target="#edit-modal"> View details </button></p>
                                                </div>
                                            </div>
                                            <div class="item">
                                                <div class="pad15">
                                                    <p class="lead">Birthday Package D</p>
                                                    <p>Min 50 guests </p>
                                                    <p>40,000 - 50,000 </p>
                                                    <p> <button type="button" class="btn btn-info" data-toggle="modal" data-target="#edit-modal"> View details </button></p>
                                                </div>
                                            </div>
                                            <div class="item">
                                                <div class="pad15">
                                                    <p class="lead">Birthday Package E</p>
                                                    <p> Min 50 </p>
                                                    <p>30,000 - 70,000</p>
                                                    <p> <button type="button" class="btn btn-info" data-toggle="modal" data-target="#edit-modal"> View details </button></p>
                                                </div>
                                            </div>
                                            <div class="item">
                                                <div class="pad15">
                                                    <p class="lead">Corporate Party Package A</p>
                                                    <p>Min 80 Guests</p>
                                                    <p>50,000</p>
                                                    <p> <button type="button" class="btn btn-info" data-toggle="modal" data-target="#edit-modal"> View details </button></p>
                                                </div>
                                            </div>
                                            <div class="item">
                                                <div class="pad15">
                                                    <p class="lead">Corporate Party Package B</p>
                                                    <p>₹ 1</p>
                                                    <p>₹ 6000</p>
                                                    <p> <button type="button" class="btn btn-info" data-toggle="modal" data-target="#edit-modal"> View details </button></p>
                                                </div>
                                            </div>

                                            
                                            <div class="item">
                                                <div class="pad15">
                                                    <p class="lead">Coporate Party Package C</p>
                                                    <p>₹ 1</p>
                                                    <p>₹ 6000</p>
                                                    <p> <button type="button" class="btn btn-info" data-toggle="modal" data-target="#edit-modal"> View details </button></p>
                                                </div>
                                            </div>
                                            <div class="item">
                                                <div class="pad15">
                                                    <p class="lead">Corporate Party Package D</p>
                                                    <p>₹ 1</p>
                                                    <p>₹ 6000</p>
                                                    <p> <button type="button" class="btn btn-info" data-toggle="modal" data-target="#edit-modal"> View details </button></p>
                                                </div>
                                            </div>
                                            <div class="item">
                                                <div class="pad15">
                                                    <p class="lead">Corporate Party Package E</p>
                                                    <p>₹ 1</p>
                                                    <p>₹ 6000</p>
                                                    <p> <button type="button" class="btn btn-info" data-toggle="modal" data-target="#edit-modal"> View details </button></p>
                                                </div>
                                            </div>
                                            <div class="item">
                                                <div class="pad15">
                                                    <p class="lead">Other Package A</p>
                                                    <p>₹ 1</p>
                                                    <p>₹ 6000</p>
                                                    <p> <button type="button" class="btn btn-info" data-toggle="modal" data-target="#edit-modal"> View details </button></p>
                                                </div>
                                            </div>
                                            <div class="item">
                                                <div class="pad15">
                                                    <p class="lead">Other Package B </p>
                                                    <p>₹ 1</p>
                                                    <p>₹ 6000</p>
                                                    <p> <button type="button" class="btn btn-info" data-toggle="modal" data-target="#edit-modal"> View details </button></p>
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary leftLst"><</button>
                                        <button class="btn btn-primary rightLst">></button>


                                    </div> 
                                
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    </div>
                                  </div>    --}}
                            
                                
                        
                                                                       
                
                    
                        {{-- </div><br> --}}
                            {{-- CUSTOMIZED PACKAGE --}}
                            
                             <div class = "container" id = "package2customized" style = "display:none">
                             <h2> Customize Packages </h2>
                                    <table width="100%" boarder="0" cellspacing="20" cellpadding="0" id="fully_customized">
                                            <tbody><tr>
                                              <td width="50%"><h3>Appetizer</h3>
                                                {{Form::checkbox('appetizer1', 'Crispy Wanton Balls', false)}}
                                                {{-- <input type="radio" name="appetizer1" value=""> --}}
                                                Crispy Wanton Balls<br>

                                                {{Form::checkbox('appetizer2', 'Beef Franks with Onion Rings', false)}}
                                                Beef Franks with Onion Rings<br>

                                                {{Form::checkbox('appetizer3', 'Shrimp Balls', false)}}
                                                Shrimp Balls<br>

                                                {{Form::checkbox('appetizer4', 'Fish Fingers', false)}}
                                                Fish Fingers<br>

                                                {{Form::checkbox('appetizer5', 'Mushroom Ala Pobre', false)}}
                                                Mushroom ala Pobre<br>

                                                {{Form::checkbox('appetizer6', 'Assorted Cold Cuts', false)}}
                                                Assorted Cold Cuts<br><br>
                                                

                                                <h3>Soup</h3>
                                                
                                                {{Form::checkbox('soup1', 'Pumpkin Soup', false)}}
                                                Pumpkin Soup<br>

                                                {{Form::checkbox('soup2', 'Cream of Mushroom', false)}}
                                                Cream of Mushroom Soup<br>
                                                
                                                {{Form::checkbox('soup2', 'Cream of Chicken and Vegetable Soup', false)}}
                                                Cream of Chicken and Vegetable Soup<br>
                                                <br><br>

                                                <h2 style="background:#eee; padding:5px 10px;">Main Course</h2>

                                                <h3>Pork</h3>
                                                {{Form::checkbox('pork1', 'Pork Ballotine in Shallot Mushroom Sauce', false)}}
                                                Pork Ballotine in Shallot Mushroom Sauce<br>

                                                {{Form::checkbox('pork2', 'Pork Strips with Quail ggs and Cashew Nuts', false)}}
                                                Pork Strips with Quail Eggs and Cashew Nuts<br>

                                                {{Form::checkbox('pork3', 'Pork Barbeque Spareribs', false)}}
                                                Pork Barbeque Spareribs<br><br>

                                                <h3>Beef</h3>
                                                {{Form::checkbox('beef1', 'Beef Lok-lak', false)}}
                                                Beef Lok-lak<br>

                                                {{Form::checkbox('beef2', 'Lengua Financiera', false)}}
                                                Lengua Financiera<br>

                                                {{Form::checkbox('beef3', 'Roast Beef with Gravy', false)}}
                                                Roast Beef with Gravy<br>
                                                
                                                <br>
                                                
                                                <h3>Chicken</h3>
                                                {{Form::checkbox('chicken1', 'Crispy Honey Chicken in Sweet Chili Sauce', false)}}
                                                Crispy Honey Chicken in Sweet Chili Sauce<br>

                                                {{Form::checkbox('chicken2', 'Roast Chicken', false)}}
                                                Roast Chicken<br>

                                                {{Form::checkbox('chicken3', 'Stuffed Boneless Chicken', false)}}
                                                Stuffed Boneless Chicken<br>
                                                
                                                <br>

                                                <h3>Seafood</h3>
                                                {{Form::checkbox('seafood1', 'Deep Fried Fish Fillet ala Mexicana (Mildly Spicy)', false)}}
                                                Deep Fried Fish Fillet ala Mexicana (Mildly Spicy)<br>

                                                {{Form::checkbox('seafood2', 'Grilled Fillet of Tanigue in Caper Butter Jus', false)}}
                                                Grilled Fillet of Tanigue in Caper Butter Jus<br>

                                                {{Form::checkbox('seafood3', 'Fish Fillet Meunièr', false)}}
                                                Fish Fillet Meunière<br></td>

                                              
                                              <td width="50%"><h3>Vegetables</h3>
                                                {{Form::checkbox('vegetable1', 'Buttered Balkan Mixed Vegetables', false)}}
                                                Buttered Balkan Mixed Vegetables<br>

                                                {{Form::checkbox('vegetable2', 'Sauteed Vegetable in Oyster Sauce', false)}}
                                                Sautéed Vegetables in Oyster Sauce<br>

                                                {{Form::checkbox('vegetable3', 'Buttered Vegetables', false)}}
                                                Buttered Vegetables<br><br>

                                                <h3>Pasta or Rice</h3>
                                                {{Form::checkbox('pastarice1', 'Angel Hair in Olive Oil Tapenade', false)}}
                                                Angel Hair in Olive Oil Tapenade<br>
                                                
                                                {{Form::checkbox('pastarice1', 'Spaghetti', false)}}
                                                Spaghetti <br>
                                                {{Form::checkbox('pastarice1', 'Lasagna', false)}}
                                                Lasagna<br>
                                                {{Form::checkbox('pastarice1', 'Steamed Rice', false)}}
                                                Steamed Rice<br><br>

                                                <h1>Dessert </h1>
                                                {{Form::checkbox('desserts1', 'Assorted Pastries', false)}}
                                                Assorted Pastries<br>
                                                {{Form::checkbox('desserts2', 'Spaghetti', false)}}
                                                Casava Cake<br>
                                                {{Form::checkbox('desserts3', 'Leche Flan', false)}}
                                                Leche Flan<br>
                                                {{Form::checkbox('desserts4', 'Buko Fruit Salad', false)}}
                                                Buko Fruit Salad<br>
                                                <br>

                                                <h1 style="background:#eee; padding:5px 10px;">Beverages</h1>
                                                <h1>Alcoholic</h1>
                                                {{Form::checkbox('alcoholic1', 'San Miguel Light', false)}}
                                                San Miguel Light<br>
                                                {{Form::checkbox('alcoholic2', 'Pale Pilsen', false)}}
                                                Pale Pilsen<br>
                                                {{Form::checkbox('alcoholic3', 'Super Dry', false)}}
                                                Super Dry<br>
                                                {{Form::checkbox('alcoholic4', 'Red Horse', false)}}
                                                Red Horse<br>
                                                 <br>

                                                <h1>Non-alcoholic</h1>
                                                {{Form::checkbox('nonalcoholic1', 'Iced Tea', false)}}
                                                Iced tea<br>
                                                {{Form::checkbox('nonalcoholic2', 'Coke', false)}}
                                                Coke<br>
                                                {{Form::checkbox('nonalcoholic3', 'Sprite', false)}}
                                                Sprite<br>
                                                {{Form::checkbox('nonalcoholic4', 'Royal', false)}}
                                                Royal<br>
                                                
                                            </td>
                                            </tr>
                                          </tbody></table>
                            </div>  
                            {{-- END CUSTOMIZED PACKAGE --}}

                            

                          <br>
                            

            <div class="amado_product_area section-padding-100">
                <div class="container-fluid">


                            </div>
                        </div>
                </div>

                {{-- MODAL SATRTS HERE --}}
                <div class="modal fade" id="edit-modal">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                                <h2 class="modal-title" text-align: center><b>Wedding Package</b></h2>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                              
                            </div>
                            <div class="modal-body">
                              <form role="form" action="/edit_user">
                                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                <div class="box-body">

                                  <div class="form-group">
                                    <label for="Soup"> <h3>  Soup </h3> </label> 
                                      {{-- INSERT DISPLAY HERE --}}
                                  </div>

                                  <div class="form-group">
                                    <label for="Appetizer"><h3> Appetizer </h3></label> 
                                    {{-- INSERT DISPLAY HERE --}}
                                  </div>
                                  <div class="form-group">
                                    <label for="Salad"> <h3> Salad Bar </h3> </label> 
                                    {{-- INSERT DISPLAY HERE --}}
                                  </div>
                                  <div class="form-group">
                                    <label for="Main Course"> <h3> Main Course </h3> </label> 
                                    {{-- INSERT DISPLAY HERE --}}
                                  </div>
                                  <div class="form-group">
                                    <label for="Pasta"> <h3> Pasta </h3></label> 
                                    {{-- INSERT DISPLAY HERE --}}
                                  </div>

                                  <div class="form-group">
                                    <label for="Rice">Rice</label> 
                                    {{-- INSERT DISPLAY HERE --}}
                                  </div> 

                                <div class="form-group">
                                    <label for="Dessert">Dessert</label> 
                                    {{-- INSERT DISPLAY HERE --}}
                                </div> 

                                <div class="form-group">
                                    <label for="Beverages">Beverages</label> 
                                    {{-- INSERT DISPLAY HERE --}}
                                </div>   

                                </div>


                                <div class="modal-footer">
                                  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                  <button type="submit" class="btn btn-primary">Select This Package</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>

                            <div class="col-md-12 mb-3">
                                    <p align = "center"> {{ Form::submit('Next: Summary', ['class' => 'btn btn-primary btn-lg'])}} </p>
                                </div>

                                {!! Form::close() !!}


                        

                        <script>
                                function toggle(x){
                                  var p1 = document.getElementById("package1accord");
                                  var p2 = document.getElementById("package2customized");
                                  var p3 = document.getElementById("package3budget");
                                  
                                    if(x=="package1"){
                                        
                                        //var test=document.getElementById('package1accord');
                                        p1.style.display="block";
                                        p2.style.display="none";
                                        p3.style.display="none";
                                        
                                        //document.getElementById("package2customized").style.visibility = "hidden";
                                        //document.getElementById("package2customized").style.visibility = "hidden";
                                        
                                    }

                                    else if(x=="package2"){
                                    //document.getElementById("package1accord").style.visibility = "hidden";
                                        //var test=document.getElementById('package2customized');
                                        p2.style.display="block";
                                        p1.style.display="none";
                                        p3.style.display="none";
                                         //document.getElementById("package3budget").style.visibility = "hidden";
                                        
                                    }

                                    else if(x=="package3"){
                                        //var test=document.getElementById('package3budget');
                                        p3.style.display="block";
                                        p2.style.display="none";
                                        p1.style.display="none";
                                        //document.getElementById("package1accord").style.visibility = "hidden";
                                         
                                    }
                                    
                                    //test.style.display = "none";
                                    
                                }
                            </script>

        {{-- <script>
            $(document).ready(function () {
            var itemsMainDiv = ('.MultiCarousel');
            var itemsDiv = ('.MultiCarousel-inner');
            var itemWidth = "";

            $('.leftLst, .rightLst').click(function () {
              var condition = $(this).hasClass("leftLst");
                  if (condition)
                      click(0, this);
                  else
                      click(1, this)
                          
                  });

            ResCarouselSize();

            $(window).resize(function () {
                ResCarouselSize();
            });

            //this function define the size of the items
            function ResCarouselSize() {
                var incno = 0;
                var dataItems = ("data-items");
                var itemClass = ('.item');
                var id = 0;
                var btnParentSb = '';
              var itemsSplit = '';
              var sampwidth = $(itemsMainDiv).width();
              var bodyWidth = $('body').width();
              $(itemsDiv).each(function () {
                  id = id + 1;
                  var itemNumbers = $(this).find(itemClass).length;
                  btnParentSb = $(this).parent().attr(dataItems);
                  itemsSplit = btnParentSb.split(',');
                  $(this).parent().attr("id", "MultiCarousel" + id);


                  if (bodyWidth >= 1200) {
                      incno = itemsSplit[3];
                      itemWidth = sampwidth / incno;
                  }
                  else if (bodyWidth >= 992) {
                      incno = itemsSplit[2];
                      itemWidth = sampwidth / incno;
                  }
                  else if (bodyWidth >= 768) {
                      incno = itemsSplit[1];
                      itemWidth = sampwidth / incno;
                  }
                  else {
                      incno = itemsSplit[0];
                      itemWidth = sampwidth / incno;
                  }
                  $(this).css({ 'transform': 'translateX(0px)', 'width': itemWidth * itemNumbers });
                  $(this).find(itemClass).each(function () {
                      $(this).outerWidth(itemWidth);
                  });

                  $(".leftLst").addClass("over");
                  $(".rightLst").removeClass("over");

              });
          }
                          //this function used to move the items
                          function ResCarousel(e, el, s) {
                              var leftBtn = ('.leftLst');
                              var rightBtn = ('.rightLst');
                              var translateXval = '';
                              var divStyle = $(el + ' ' + itemsDiv).css('transform');
                              var values = divStyle.match(/-?[\d\.]+/g);
                              var xds = Math.abs(values[4]);
                              if (e == 0) {
                                  translateXval = parseInt(xds) - parseInt(itemWidth * s);
                                  $(el + ' ' + rightBtn).removeClass("over");

                                  if (translateXval <= itemWidth / 2) {
                                      translateXval = 0;
                                      $(el + ' ' + leftBtn).addClass("over");
                                  }
                              }
                              else if (e == 1) {
                                  var itemsCondition = $(el).find(itemsDiv).width() - $(el).width();
                                  translateXval = parseInt(xds) + parseInt(itemWidth * s);
                                  $(el + ' ' + leftBtn).removeClass("over");

                                  if (translateXval >= itemsCondition - itemWidth / 2) {
                                      translateXval = itemsCondition;
                                      $(el + ' ' + rightBtn).addClass("over");
                                  }
                              }
                              $(el + ' ' + itemsDiv).css('transform', 'translateX(' + -translateXval + 'px)');
                          }

                          //It is used to get some elements from btn
                          function click(ell, ee) {
                              var Parent = "#" + $(ee).parent().attr("id");
                              var slide = $(Parent).attr("data-slide");
                              ResCarousel(ell, Parent, slide);
                          }

                      });
        </script> --}}

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection