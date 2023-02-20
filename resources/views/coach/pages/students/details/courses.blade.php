
<div class="row">
    <div class="col-12">
        <div class="card shadow">
            <div id="course_list" class="card-body table-card-body table-responsive">
                <table id="student_course" class="student_course-table table table-striped table-bordered w-100 text-nowrap">
                    <thead>
                        <tr>
                            <th class="wd-15p notexport">Select</th>
                            <th class="wd-15p">ID</th>
                            <th class="wd-15p">Course Code</th>
                            <th class="wd-15p">Course Name</th>
                            <th class="wd-20p">Completed<br /> Activities</th>
                            <th class="wd-10p">Inprogress<br /> Activities</th>
                            <th class="wd-10p">Pending<br /> Activities</th>
                            <th class="wd-10p">Complete(%)</th>
                            <th class="save">Save</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($regCourses) {
                            $slno = 1;
                            for($i=0; $i<100; $i=$i+5){ $percent[$i] = $i; }
                            foreach ($regCourses as $row) {
                                ?>
                                <tr class="dtrow" id="dtrow-<?php echo $row->regId; ?>">
                                    <td></td>
                                    <td>{{$slno}}</td>
                                    <td>{{$row->course_code}}</td>
                                    <td>{{$row->course_name}}</td>
                                    <td>{{$row->complete}}</td>
                                    <td>{{$row->process}}</td>
                                    <td>{{$row->pending}}
                                    <td class="text-center">
                                        <div class="col-md-12 fl">
                                            {{Form::hidden('prev_percent_'.$row->regId,$row->complete_percent,['id'=>'prev_percent_'.$row->regId])}}
                                            {{Form::select('complete_percent',$percent,$row->complete_percent,['id'=>'complete_percent_'.$row->regId,'class'=>'form-control complete_percent'])}}
                                            
                                        </div
                                    </td>
                                    <td class="text-center">
                                        <a href="{{url('coach/student/'.$row->regId.'/'.$row->student_id)}}" class="btn btn-sm btn-info"> <i class="fa fa-eye"></i>View</a>
                                        
                                    </td>
                                </tr>
                                <?php
                                $slno++;
                            }
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th class="wd-15p search-by">Search By:</th>
                            <th class="wd-15p">ID</th>
                            <th class="wd-15p">Course Code</th>
                            <th class="wd-20p">Course Name</th>
                            <th class="wd-10p">Complete</th>
                            <th class="wd-10p">Inprogerss</th>
                            <th class="wd-10p">Pending</th>
                            <th class="wd-10p text-center action-search"></th>
                            <th class="wd-10p text-center action-search"></th>
                        </tr>
                    </tfoot>
                </table>
            </div>

        </div>
    </div>
</div>
                        
<script type="text/javascript">
    $(document).ready(function(){
        $('.complete_percent').on('change',function(){
            var cId     =   this.id;
            var id      =   this.id.replace('complete_percent_','');
            var val     =   this.value;
            var url     =   '{{url("coach/update/course/percent")}}';
            var prevVal =   $('#prev_percent_'+id).val(); 
            if(prevVal  ==  val) return false;
            updatePercentage(id,cId,val,url,prevVal);
        });
        
//        $('.updBtn').on('click',function(){
//            var id      =   this.id;
//            var val     =   $('#complete_percent_'+id).val();
//            $(this).attr('disabled',true);
//            $.ajax({
//                type: "POST",
//                url: '{{url("coach/update/course/percent")}}',
//                data: {id: id, percent: val},
//                success: function (data) {
//                    if(data > 0){
//                        var msg = 'Comptete status updated successfully';
//                        $('.statusMsg').show();
//                        $(".statusMsg").html('<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button>'+msg+'</div>');
//                        $('.updBtn').attr('disabled',false);
//                        setTimeout(function(){ $('.statusMsg').hide('slow'); }, 3000 );
//                    }
//                }
//            });
//        });
    });
    
    function updatePercentage(id,cId,val,url,prevVal){
        swal({
            title: "Are you sure?", text: "", type: "info", showCancelButton: true, confirmButtonColor: "#DD6B55", confirmButtonText: "Yes", cancelButtonText: "No", closeOnConfirm: true, closeOnCancel: true
        }, function (isConfirm) {
        if (isConfirm){
                $.blockUI({message: "<h4>Processing...</h4>"});
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {id: id, percent: val},
                    success: function (data) {
                        $.unblockUI();
                        if(data > 0){
                            var msg = 'Comptete status updated successfully';
                            $('.statusMsg').show();
                            $(".statusMsg").html('<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button>'+msg+'</div>');
                            $('#prev_percent_'+id).val(val);
                            setTimeout(function(){ $('.statusMsg').hide('slow'); }, 3000 );
                        } 
                    }
                });
            }else{ $('#'+cId).val(prevVal); }
        });
    }
</script>
<script src="{{asset('public/coach/assets/js/datatable/student_course-datatable.js')}}"></script>
