
<div>
    <table id="session_request" class="session_request-table table table-striped table-bordered w-100 text-nowrap">
        <thead>
            <tr>
                <th class="wd-15p notexport">Select</th>
                <th class="wd-15p">Activity Code</th>
                <th class="wd-15p">Activity Name</th>
                <th class="wd-20p">Student</th>
                <th class="wd-15p">Submited On</th>
                <th class="wd-10p">Status</th>
                <th class="wd-25p text-center notexport action-btn">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($activities) {
                $slno = 1;
                foreach ($activities as $row) {
                    if($row->act_status != 'Pending'){ $disabled = 'disabled="disabled"'; }else{ $disabled = ''; }
                    ?>
                    <tr class="dtrow" id="dtrow-{{$row->id}}">
                        <td></td>
                        <td>{{$row->activity_code}}</td>
                        <td>{{$row->activity_name}}</td>
                        <td>{{$row->name}}</td>
                        <td>{{$row->submited_at}}</td>
                        <td id="act_status-{{$row->id}}">{{$row->act_status}}</td>
                        <td class="text-center">
                            {{Form::hidden('user-'.$row->id,$row->user_id,['id'=>'user-'.$row->id])}}
                            <a href="{{url('/coach/activity/session/request/'.$row->id)}}" id="e-{{$row->id}}" data-value="Edit" class="btn btn-sm btn-primary btn-edit"><i class="fa fa-edit"></i> Edit</a>
                            <button id="a-{{$row->id}}" data-value="Approved" <?php echo $disabled?> class="btn btn-sm btn-success approveBtn"><i class="fa fa-check"></i> Approve</button>
                            <button id="r-{{$row->id}}" data-value="Rejected" <?php echo $disabled?> class="btn btn-sm btn-danger approveBtn"><i class="fa fa-ban"></i> Reject</button>
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
                <th class="wd-15p">Activity Code</th>
                <th class="wd-15p">Activity Name</th>
                <th class="wd-20p">Student</th>
                <th class="wd-10p">Submited On</th>
                <th class="wd-20p">Status</th>
                <th class="wd-25p text-center action-search"></th>
            </tr>
        </tfoot>
    </table>
    {{ csrf_field() }}
    <input type="hidden" name="baseurl" id="baseurl" value="<?php echo $app->make('url')->to('/'); ?>">
</div>
<script src="{{asset('public/coach/assets/js/datatable/session_request-datatable.js')}}"></script>
