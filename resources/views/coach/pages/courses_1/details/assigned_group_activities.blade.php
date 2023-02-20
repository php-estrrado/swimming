@if(count($grActivities) > 0)
    <div class="gr-act-title">
        <div class="col-4 col-md-1 fl"><div class="row">Code</div></div>
        <div class="col-8 col-md-4 fl">Activity</div>
        <div class="col-12 col-md-6 fl">Description</div>
        <div class="col-3 col-md-1 fr"><div class="row">&nbsp;</div></div>
        <div class="clr"></div>
    </div>
    @foreach($grActivities as $k=>$row)  
        @php 
            if($row->active == 1){ $active = "Active"; $checked = true; } else{ $active = "Inactive"; $checked = false; } 
            if(strlen($row->activity_desc) > 250){ $ext = '...'; }else{ $ext = ''; }
        @endphp
        <div id="gr-act-content-{{$group->id}}">
            <div id="act-{{$row->id}}" class="act odd">
                <div class="col-4 col-md-1 fl"><div class="row">{{$row->activity_code}}</div></div>
                <div class="col-8 col-md-4 fl">{{$row->activity_name}}</div>
                <div class="col-12 col-md-6 fl">{{substr($row->activity_desc, 0, 250).$ext}}</div>
                <div class="col-12 col-md-1 fl"><div class="row">
                    {{Form::hidden('act_name', $row->activity_name, ['id'=>'act_name-'.$row->id])}}
                    {{Form::hidden('act_desc', $row->activity_desc, ['id'=>'act_desc-'.$row->id])}}
                    {{Form::hidden('act_status', $row->active, ['id'=>'act_status-'.$row->id])}}
                    {{Form::hidden('act_msId', $row->ms_id, ['id'=>'act_msId-'.$row->id])}}
                    <div class="fl link"><i id="{{$row->id}}" title="View Media" class="edit-media fa fa-image"></i></div>
                    <div class="fl link abs"><i id="{{$row->id}}" title="View Activity" class="edit-act fa fa-eye"></i></div>
                </div></div>
                <div class="clr"></div>
            </div>
        </div>
    @endforeach
@else
    <div class="no-rec-container"><div class="no-record tac">No records found.</div> </div>
@endif