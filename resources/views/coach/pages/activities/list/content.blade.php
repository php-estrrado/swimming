<div class="table-responsive">
    <table id="activity" class="activity-table table table-striped table-bordered w-100 text-nowrap">
        <thead>
            <tr>
                <th class="wd-15p notexport">Select</th>
                <th class="wd-15p">Code</th>
                <th class="wd-15p">Activity Name</th>
                <th class="wd-20p">Student</th>
                <th class="wd-10p">Submited On</th>
                <th class="wd-10p">Status</th>
                <th class="wd-25p text-center notexport action-btn">Action</th>
            </tr>
        </thead>
        <tbody>
            @if($activities)
                @foreach($activities as $row)
                    @php 
                        if($row->act_status == 1){ $row->status_name = 'Pending '; }
                        if($row->act_status == 1 && $row->curr_status == 2){ $actionBtn = true; }else{ $actionBtn = false; }
                    @endphp
                    <tr class="dtrow" id="dtrow-{{$row->id}}">
                        <td></td>
                        <td>{{$row->activity_code}}</td>
                        <td>{{$row->activity_name}}</td>
                        <td>{{$row->name}}</td>
                        <td>{{date("d M Y",strtotime($row->submited_at))}}</td> 
                        <td id="status-{{$row->id}}">{{$row->status_name}}</td>
                        <td class="text-center">
                            <a href="{{url('/coach/submitted/activity/'.$row->id)}}"><button id="sActViewBtn-{{$row->id}}" class="btn btn-sm btn-primary btn-info sActViewBtn"><i class="fa fa-eye"></i>View</button></a>
                            @if($actionBtn)
                            {{Form::hidden('user-'.$row->id,$row->user_id,['id'=>'user-'.$row->id])}}
                            <button id="app-{{$row->id}}" data-id="{{$row->reg_activity_id}}" class="btn btn-sm btn-success actApprove"><i class="fa fa-check"></i>Approve</button>
                            <button id="rej-{{$row->id}}" data-id="{{$row->reg_activity_id}}" class="btn btn-sm btn-danger actReject"><i class="fa fa-ban"></i>Reject</button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
        <tfoot>
            <tr>
                <th class="wd-15p search-by">Search By:</th>
                <th class="wd-15p">Code</th>
                <th class="wd-15p">Course Name</th>
                <th class="wd-20p">Student</th>
                <th class="wd-10p">Submitted On</th>
                <th class="wd-10p">Status</th>
                <th class="wd-25p text-center action-search"></th>
            </tr>
        </tfoot>
    </table>
    {{ csrf_field() }}
    <input type="hidden" name="baseurl" id="baseurl" value="<?php echo $app->make('url')->to('/'); ?>">
</div>
<script src="{{asset('public/coach/assets/js/datatable/activity-datatable.js')}}"></script>
