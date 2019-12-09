<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('layouts.headers.inventoryCard', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <div class="container-fluid mt--7">
            
            <div class="col-xl-12 mb-5">
                <div class="card shadow " >
                    <div class="card-header ">
                        <div class="row align-items-center">
                            <div class="col">
                                <div class="row">
                                <div class="col-xs-5">
                                    <h1 class="mb-0">Upcoming Events</h1>
                                </div>
                                <div class="col-xs-2">
                                        &nbsp;&nbsp;
                                </div>
                                
                                </div>
                            </div>
                            <div class="col text-right"> </div>
                            <div class="col text-left">
                                <div class="col-xs-5"> 
                                    <input class="form-control" id="myInput" type="search" onkeyup="searchTable()" style="background: transparent;" placeholder="Search Item Here">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <?php if(session()->has('success')): ?>
                                    <br>
                                    <div class="alert alert-success" role="alert">
                                        <button type="button" data-dismiss="alert" class="close"><span aria-hidden="true">x</span></button>
                                        <?php echo e(session()->get('success')); ?><br>
                                    </div>
                                <?php endif; ?>
                                <?php if(session()->has('deleted')): ?>
                                    <br>
                                    <div class="alert alert-danger" role="alert">
                                        <button type="button" data-dismiss="alert" class="close"><span aria-hidden="true">x</span></button>
                                        <?php echo e(session()->get('deleted')); ?><br>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                       
                    </div>
                    <div class="card-body">

                    

                    <div class="table-responsive mb-3">
                        <!-- Projects table -->
                        
                        <table class="table table-bordered align-items-center table-flush mb-4" id="myTable">
                            <thead class="thead-light">
                                <tr>
                                    <th >Item name</th>
                                    
                                    <th >Category</th>
                                    <th>Color</th>
                                    <th>Size</th>
                                    <th >Quantity</th>
                                    <th >Threshold</th>
                                    <th >Last Modified (YY-MM-DD)</th>
                                    <th >Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php  

                                ?>

                                
                            </tbody>
                        </table>
                    </div>
                    </div>
                    <div class="card-footer">
                            <div id="pageNavPosition" style="padding-top: 20px; cursor: pointer;" align="center"></div>
                            <script type="text/javascript">
                                <!--
                                var pager = new Pager('myTable', 5);
                                pager.init();
                                pager.showPageNav('pager', 'pageNavPosition');
                                pager.showPage(1);
                            </script>
                    </div>
                    </div>
                    <!--pagination-->
                    
                    <!--pagination-->

                    </div>


                    


                   
                            <!--pagination-->
                            
                            <!--pagination-->
        
                        </div>
                    </div>
                </div>
                </div>
                </div>
            </div>
            </div>
        </div>
    </div>
    </div>
    
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
    
    
    <script>
        $('.table-responsive tbody tr').slice(-2).find('.dropdown').addClass('dropup');

        function printContent(el){
            var restorepage = $('body').html();
            var printcontent = $('#' + el).clone();
            $('body').empty().html(printcontent);
            window.print();
            $('body').html(restorepage);
            document.location.reload(true);
            
            // var restorepage = document.body.innerHTML;
            // var printcontent = document.getElementById().innerHTML;
            // document.body.innerHTML = printcontent;
            // window.print();
            // document.body.innerHTML = restorepage;
        }
    </script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>