@extends('layouts.app')
@section('title', 'Add Packages')

{{-- @include('layouts.headers.pagination') --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js">

</script>

@section('content') 
    @include('layouts.headers.eventsCard')

    <div class="container-fluid mt--7">
            {{-- <div class="col-xl-8 mb-5 mb-xl-0"> --}}
        <div class="col-xl-12 mb-5">
        <div class="card shadow " >
        <div class="card-header ">
        <div class="row align-items-center">
        <div class="col">
        <div class="row">

        <div class="col-xs-5">
             <h1 class="">Add Packages</h1>
        </div>
                                
        <div class="col-xs-2">
            &nbsp;&nbsp;
        </div>
                               
        </div>
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
            </div>
            </div>
                            {!! Form::open(['action' => 'AddPackageController@store', 'method' => 'POST']) !!}
                        <div class="card-body border-0"></div>

                         <div class="row">
                            <div class="col-md-5 mb-3">
                                 <label class = "form-label"> Package Name </label>
                                {{ Form::text('packageName', '', ['class' => 'form-control', 'placeholder' => 'Package Name', 'required' => 'true'])}}
                           </div>

                           <div class="col-md-5 mb-3">
                            <label class = "form-label"> Package Price </label>
                           {{ Form::number('packageprice', '', ['class' => 'form-control', 'placeholder' => '0.00', 'required' => 'true', 'min' => '1', 'step' => '0.01', 'disabled'])}}
                            </div>

                            <br>

                            <div class="table-responsive">
                               
                                 <span id="result"></span>
                                
                                 <table class="table table-bordered table-striped" id="user_table">
                               <thead>
                                <tr>
                                    <th width="30%"> Inventory Name</th>
                                    <th width="30%">Quantity</th>
                                    <th width="30%">Price</th>
                                    <th width="30%">Action</th>
                                </tr>
                               </thead>
                               <tbody>
                
                               </tbody>
                               <tfoot>
                                {{-- <tr>
                                                <td colspan="2" align="right">&nbsp;</td>
                                                <td>
                                  @csrf
                                  <input type="submit" name="save" id="save" class="btn btn-primary" value="Save" />
                                 </td>
                                </tr> --}}
                               </tfoot>
                           </table>
                              
                              </div>
                             </div>
                             <br>
                            <div class="col-md-12 mb-3">
                                    <p style="text-align:center">
                                         {{ Form::submit('Add Package', ['class' => 'btn btn-primary']) }} 
                                    </p>
                                 </div>
                                 
                                 {!! Form::close() !!} 
                        </div>
                </div>
                
            </div>
        </div>
    </div>

    
        
  


@endsection

<script>
        $(document).ready(function(){
        
         var count = 1;
        
         addpackages(count);
        
         function addpackages(number)
         {
          html = '<tr>';
                html += '<td> <select name="name[]" class = "form-control"> <br>  <br> <option disabled selected > -Select Inventory Name- </option> @foreach($Inventory as $inventory) <option value ="{{ $inventory->inventory_name }}"> {{ $inventory->inventory_name }} </option> <br> @endforeach <br> </select> </td>';


                html += '<td><input type="number" name="quantity[]" class="form-control" placeholder="0" min="1"/></td>';
                html += '<td><input type="number" name="price[]" class="form-control" placeholder="0.00" step="0.01" min="0"/></td> ';

                if(number > 1)
                {
                    html += '<td><button type="button" name="remove" id="" class="btn btn-danger remove">Remove</button></td></tr>';
                    $('tbody').append(html);
                }
                else
                {   
                    html += '<td><button type="button" name="add" id="add" class="btn btn-success">Add</button></td></tr>';
                    $('tbody').html(html);
                }
         }
        
         $(document).on('click', '#add', function(){
          count++;
          addpackages(count);
         });
        
         $(document).on('click', '.remove', function(){
          count--;
          $(this).closest("tr").remove();
         });
        
       
        
        });
        </script>