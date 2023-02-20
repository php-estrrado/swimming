
<div class="row">
    <div class="col-12">
        <div class="card shadow">
            <div id="student_list" class="card-body table-card-body table-responsive">
                <table id="student" class="student-table table table-striped table-bordered w-100 text-nowrap">
                    <thead>
                        <tr>
                            <th class="wd-15p notexport">Select</th>
                            <th class="wd-15p">ID</th>
                            <th class="wd-15p">Student Name</th>
                            <th class="wd-20p">Completed<br /> Activities</th>
                            <th class="wd-10p">Inprogress<br /> Activities</th>
                            <th class="wd-10p">Pending<br /> Activities</th>
                            <th class="wd-10p">Complete(%)</th>
                            <th class="wd-15p">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($students) {
                            $slno = 1;
                            for($i=0; $i<100; $i=$i+5){ $percent[$i] = $i; }
                            foreach ($students as $row) {
                                ?>
                                <tr class="dtrow" id="dtrow-<?php echo $row->regId; ?>">
                                    <td></td>
                                    <td>{{$slno}}</td>
                                    <td>{{$row->name}}</td>
                                    <td>{{$row->complete}}</td>
                                    <td>{{$row->process}}</td>
                                    <td>{{$row->pending}}</td>
                                    <td class="text-center">
                                        <div class="">
                                            <div class="col-md-6 fl"><div class="row">
                                                {{Form::select('complete_percent',$percent,$row->complete_percent,['id'=>'complete_percent_'.$row->regId,'class'=>'form-control complete_percent'])}}
                                                </div></div>
                                            <div class="col-md-6 fl"><div class="row">{{Form::button('Save',['id'=>$row->regId,'class'=>'btn btn-sm btn-primary updBtn'])}}</div></div>
                                        </div>
                                    </td>
                                    <td class="text-center"><a href="{{url('coach/course/'.$row->regId.'/'.$row->user_id)}}" class="btn btn-sm btn-info"> <i class="fa fa-eye"></i>View</a> </td>
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
                            <th class="wd-20p">Student Name</th>
                            <th class="wd-10p">Complete</th>
                            <th class="wd-10p">Inprogerss</th>
                            <th class="wd-10p">Pending</th>
                            <th class="wd-25p text-center action-search"></th>
                            <th class="wd-25p text-center action-search"></th>
                        </tr>
                    </tfoot>
                </table>
            </div>

        </div>
    </div>
</div>
                        
<script type="text/javascript">
    $(document).ready(function(){
        $('.updBtn').on('click',function(){
            var id      =   this.id;
            var val     =   $('#complete_percent_'+id).val();
            $(this).attr('disabled',true);
            $.ajax({
                type: "POST",
                url: '{{url("coach/update/course/percent")}}',
                data: {id: id, percent: val},
                success: function (data) {
                    if(data > 0){
                        var msg = 'Comptete status updated successfully';
                        $('.statusMsg').show();
                        $(".statusMsg").html('<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button>'+msg+'</div>');
                        setTimeout(function(){ $('.statusMsg').hide('slow'); }, 3000 );
                    } $('.updBtn').attr('disabled',false);
                }
            });
        });
    });
</script>
<script src="{{asset('public/coach/assets/js/datatable/student-datatable.js')}}"></script>
