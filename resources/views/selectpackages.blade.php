@extends('layouts.app')
@section('title', 'BookEvent')

{{-- @include('layouts.headers.pagination') --}}

@section('content') 
    @include('layouts.headers.eventsCard')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

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
                                    <div class= "col-md-12 mb-3"> <h1> Select Packages <font color="red">*</font></h1>
                            </div>
                            

                            <div class= "col-md-12 mb-3"> 
                            <label class="radio-inline">
                                <input type="radio"  name="default" value = "package1" onchange="toggle(this.value)"> 
                                <h2> Default Packages</h2>
                            </label>
                            
                            <label class="radio-inline">
                                <input type="radio" name="custom" value="package2" onchange="toggle(this.value)"> 
                                <h2> Customize Packages </h2>
                            </label>
                                
                            <label class="radio-inline">
                                <input type="radio" name="budget" value="package3" onchange="toggle(this.value)"> 
                                <h2> Budget Packages </h2>
                            </label>

                            <br><br><br>
                            

                            {{-- ACCORDION STARTS HERE --}}
                           <br>
                            <div class="container"  id = "package1accord" style="display:none">
                                    <div class="panel-group" id="accordion">
                                      <div class="panel panel-default">
                                        <div class="panel-heading">
                                          <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Grand Wedding Package A</a>
                                          </h4>
                                        </div>
                                        <div id="collapse1" class="panel-collapse collapse in">
                                          <div class="panel-body">Appetizers</div>
                                        </div>
                                      </div>

                                      <div class="panel panel-default">
                                        <div class="panel-heading">
                                          <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Grand Wedding Package B</a>
                                          </h4>
                                        </div>
                                        <div id="collapse2" class="panel-collapse collapse in">
                                          <div class="panel-body">Appetizers</div>
                                        </div>
                                      </div>

                                      <div class="panel panel-default">
                                        <div class="panel-heading">
                                          <h4 class="panel-title">
                                            <a data-toggle="collapse"  href="#collapse3">Grand Wedding Package C</a>
                                          </h4>
                                        </div>
                                        <div id="collapse3" class="panel-collapse collapse in">
                                          <div class="panel-body">Appetizer</div>
                                        </div>
                                      </div>

                                      <div class="panel panel-default">
                                            <div class="panel-heading">
                                              <h4 class="panel-title">
                                                <a data-toggle="collapse"  href="#collapse4">Grand Debut Package A</a>
                                              </h4>
                                            </div>
                                            <div id="collapse4" class="panel-collapse collapse in">
                                              <div class="panel-body">Appetizers</div>
                                            </div>
                                     </div>
                                    
                                    <div class="panel panel-default">
                                            <div class="panel-heading">
                                              <h4 class="panel-title">
                                                <a data-toggle="collapse"  href="#collapse5">Grand Debut Package B</a>
                                              </h4>
                                            </div>
                                            <div id="collapse5" class="panel-collapse collapse in">
                                              <div class="panel-body">Appetizers</div>
                                            </div>
                                    </div> 

                                    <div class="panel panel-default">
                                            <div class="panel-heading">
                                              <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse6">Grand Debut Package C</a>
                                              </h4>
                                            </div>
                                            <div id="collapse6" class="panel-collapse collapse in">
                                              <div class="panel-body">Appetizers</div>
                                            </div>
                                    </div> 

                                    <div class="panel panel-default">
                                            <div class="panel-heading">
                                              <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse7">Grand Party Package A</a>
                                              </h4>
                                            </div>
                                            <div id="collapse7" class="panel-collapse collapse in">
                                              <div class="panel-body">Appetizers</div>
                                            </div>
                                    </div> 

                                    <div class="panel panel-default">
                                            <div class="panel-heading">
                                              <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse8">Grand Party Package B</a>
                                              </h4>
                                            </div>
                                            <div id="collapse8" class="panel-collapse collapse in">
                                              <div class="panel-body">Appetizers</div>
                                            </div>
                                    </div>
                                    
                                    <div class="panel panel-default">
                                            <div class="panel-heading">
                                              <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse9">Grand Party Package C</a>
                                              </h4>
                                            </div>
                                            <div id="collapse9" class="panel-collapse collapse in">
                                              <div class="panel-body">Appetizers</div>
                                            </div>
                                    </div> 

                                    <div class="panel panel-default">
                                            <div class="panel-heading">
                                              <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse10">Buffet Menu Selection A</a>
                                              </h4>
                                            </div>
                                            <div id="collapse10" class="panel-collapse collapse in">
                                              <div class="panel-body">Appetizers</div>
                                            </div>
                                    </div> 

                                    <div class="panel panel-default">
                                            <div class="panel-heading">
                                              <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse11">Buffet Menu Selection B</a>
                                              </h4>
                                            </div>
                                            <div id="collapse11" class="panel-collapse collapse in">
                                              <div class="panel-body">Appetizers</div>
                                            </div>
                                    </div> 

                                    <div class="panel panel-default">
                                            <div class="panel-heading">
                                              <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse12">Buffet Menu Selection C</a>
                                              </h4>
                                            </div>
                                            <div id="collapse12" class="panel-collapse collapse in">
                                              <div class="panel-body">Appetizers</div>
                                            </div>
                                    </div> 

                                  </div>
                            </div> 
                            {{-- End of ACCORDION HERE --}}
                            

                            {{-- CUSTOMIZED PACKAGE --}}
                            <br>
                            
                            <div class = "container" id = "package2customized" style = "display:none">
                             <h1> Customize Packages </h1>
                                    <table width="100%" boarder="0" cellspacing="20" cellpadding="0" id="fully_customized">
                                            <tbody><tr>
                                              <td width="50%"><h1>Appetizer</h1>
                                                {{Form::checkbox('appetizer1', 'Crispy Wanton Balls', false)}}
                                                {{-- <input type="radio" name="appetizer1" value=""> --}}
                                                Crispy Wanton Balls<br>

                                                {{Form::radio('appetizer2', 'Beef Franks with Onion Rings', false)}}
                                                Beef Franks with Onion Rings<br>

                                                {{Form::radio('appetizer3', 'Shrimp Balls', false)}}
                                                Shrimp Balls<br>

                                                {{Form::radio('appetizer4', 'Fish Fingers', false)}}
                                                Fish Fingers<br>

                                                {{Form::radio('appetizer5', 'Mushroom Ala Pobre', false)}}
                                                Mushroom ala Pobre<br>

                                                {{Form::radio('appetizer6', 'Assorted Cold Cuts', false)}}
                                                Assorted Cold Cuts<br><br>
                                                

                                                <h1>Soup</h1>
                                                <input type="radio" name="soup1" value="Pumpkin Soup">
                                                Pumpkin Soup<br>
                                                <input type="radio" name="soup2" value="Cream of Mushroom Soup">
                                                Cream of Mushroom Soup<br>
                                                <input type="radio" name="soup3" value="Cream of Chicken and Vegetable Soup">
                                                Cream of Chicken and Vegetable Soup<br>
                                                <br><br>

                                                <h1 style="background:#eee; padding:5px 10px;">Main Course</h1>
                                                <h1>Pork</h1>
                                                <input type="radio" name="pork1" value="Pork Ballotine in Shallot Mushroom Sauce">
                                                Pork Ballotine in Shallot Mushroom Sauce<br>
                                                <input type="radio" name="pork2" value="Pork Strips with Quail Eggs and Cashew Nuts">
                                                Pork Strips with Quail Eggs and Cashew Nuts<br>
                                                <input type="radio" name="pork3" value="Pork Barbeque Spareribs">
                                                Pork Barbeque Spareribs<br><br>

                                                <h1>Beef</h1>
                                                <input type="radio" name="beef1" value="Beef Lok-lak">
                                                Beef Lok-lak<br>
                                                <input type="radio" name="beef2" value="Lengua Financiera">
                                                Lengua Financiera<br>
                                                <input type="radio" name="beef3" value="Roast Beef with Gravy">
                                                Roast Beef with Gravy<br><br>
                                                
                                                <h1>Chicken</h1>
                                                <input type="radio" name="chicken1" value="Crispy Honey Chicken in Sweet Chili Sauce">
                                                Crispy Honey Chicken in Sweet Chili Sauce<br>
                                                <input type="radio" name="chicken2" value="Roast Chicken">
                                                Roast Chicken<br>
                                                <input type="radio" name="chicken3" value="Stuffed Boneless Chicken">
                                                Stuffed Boneless Chicken<br><br>

                                                <h1>Seafood</h1>
                                                <input type="radio" name="seafood1" value="Deep Fried Fish Fillet ala Mexicana (Mildly Spicy)">
                                                Deep Fried Fish Fillet ala Mexicana (Mildly Spicy)<br>
                                                <input type="radio" name="seafood2" value="Grilled Fillet of Tanigue in Caper Butter Jus">
                                                Grilled Fillet of Tanigue in Caper Butter Jus<br>
                                                <input type="radio" name="seafood3" value="Fish Fillet Meunière">
                                                Fish Fillet Meunière<br></td>

                                              <td width="50%"><h1>Vegetables</h1>
                                                <input type="radio" name="vegetable1" value="Buttered Balkan Mixed Vegetables">
                                                Buttered Balkan Mixed Vegetables<br>
                                                <input type="radio" name="vegetable2" value="Sautéed Vegetables in Oyster Sauce">
                                                Sautéed Vegetables in Oyster Sauce<br>
                                                <input type="radio" name="vegetable3" value="Buttered Vegetables">
                                                Buttered Vegetables<br><br>

                                                <h1>Pasta or Rice</h1>
                                                <input type="radio" name="pasta_or_rice1" value="Buttered Vegetables">
                                                Angel Hair in Olive Oil Tapenade<br>
                                                <input type="radio" name="pasta_or_rice2" value="Spaghetti Carbonara">
                                                Spaghetti Carbonara<br>
                                                <input type="radio" name="pasta_or_rice3" value="Lasagna">
                                                Lasagna<br>
                                                <input type="radio" name="pasta_or_rice4" value="Steamed Rice">
                                                Steamed Rice<br><br>

                                                <h1>Dessert </h1>
                                                <input type="radio" name="dessert1" value="Steamed Rice">
                                                Assorted Pastries<br>
                                                <input type="radio" name="dessert2" value="Casava Cake">
                                                Casava Cake<br>
                                                <input type="radio" name="dessert3" value="Leche Flan">
                                                Leche Flan<br>
                                                <input type="radio" name="dessert4" value="Buko Fruit Salad">
                                                Buko Fruit Salad<br>
                                                <br>

                                                <h1 style="background:#eee; padding:5px 10px;">Beverages</h1>
                                                <h1>Alcoholic</h1>
                                                <input type="radio" name="alcoholic1" value="San Miguel Light">
                                                San Miguel Light<br>
                                                <input type="radio" name="alcoholic2" value="Pale Pilsen">
                                                Pale Pilsen<br>
                                                <input type="radio" name="alcoholic3" value="Super Dry">
                                                Super Dry<br>
                                                <input type="radio" name="alcoholic4" value="Red Horse">
                                                Red Horse<br>
                                                <input type="radio" name="alcoholic5" value="Strong Ice">
                                                Strong Ice<br>
                                                <input type="radio" name="alcoholic6" value="San Miguel Premium">
                                                San Miguel Premium<br>
                                                <input type="radio" name="alcoholic7" value="San Miguel Apple">
                                                San Miguel Apple<br>
                                                <input type="radio" name="alcoholic8" value="San Miguel Lemon">
                                                San Miguel Lemon<br>
                                                <br>
                                                <h1>Non-alcoholic</h1>
                                                <input type="radio" name="non_alcoholic1" value="Iced tea">
                                                Iced tea<br>
                                                <input type="radio" name="non_alcoholic2" value="Coke">
                                                Coke<br>
                                                <input type="radio" name="non_alcoholic3" value="Sprite">
                                                Sprite<br>
                                                <input type="radio" name="non_alcoholic4" value="Royal">
                                                Royal<br>
                                                <input type="radio" name="non_alcoholic5" value="Root Beer">
                                                Root Beer<br>
                                                <input type="radio" name="non_alcoholic6" value="Orange Juice">
                                                Orange Juice<br>
                                                <input type="radio" name="non_alcoholic7" value="Pineapple Juice">
                                                Pineapple Juice<br></td>
                                            </tr>
                                          </tbody></table>
                            </div>  
                            {{-- END CUSTOMIZED PACKAGE --}}

    <br>
                            <div class = "container" id = "package3budget" style = "display:none">
                            <h2> Enter your budget amount <font color="red">*</font></h2>
                                {{ Form::text('budget', ' ', ['class' => 'form-control', 'placeholder' => 'Event Name', 'required' => 'true'])}}
                            </div>

                        </div>
                    </div>
                </div>


                            <div class="col-md-12 mb-3">
                                    <p align = 'center'> {{ Form::submit('Next: Summary', ['class' => 'btn btn-primary btn-lg'])}} </p>
                                </div>

                                {!! Form::close() !!}


                            
                        <script>
                                function toggle(x){
                                    if(x=="package1"){
                                        var test=document.getElementById('package1accord');
                                         test.style.display="block";
                                    }

                                    else if(x=="package2"){
                                        var test=document.getElementById('package2customized');
                                         test.style.display="block";
                                    }

                                    else if(x=="package3"){
                                        var test=document.getElementById('package3budget');
                                         test.style.display="block";
                                    }
                                }
                            </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>