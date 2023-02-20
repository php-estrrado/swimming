<div class="d-flex flex-row-reverse mb-2">
    <div class="p-2">{{ Form::button('Add Activity', array('id'=>'add_act_btn-'.$msId,'class'=>'btn btn-primary pull-right addAct_btn','type'=>'button','data-id'=>$msId)) }} </div>
</div>
@if(count($activities) > 0)
    <div class="act-title">
        <div class="col-4 col-md-1 fl"><div class="row">Code</div></div>
        <div class="col-7 col-md-3 fl">Activity</div>
        <div class="col-8 col-md-5 fl">Description</div>
        <div class="col-2 col-md-2 fl">Status</div>
        <div class="col-3 col-md-1 fr"><div class="row">&nbsp;</div></div>
        <div class="clr"></div>
    </div>
    @foreach($activities as $k=>$row)  
        @php 
            if($row->active == 1){ $active = "Active"; $checked = true; } else{ $active = "Inactive"; $checked = false; } 
            if(strlen($row->activity_desc) > 250){ $ext = '...'; }else{ $ext = ''; }
         //   echo '<pre>'; print_r($row); echo '</pre>';
        @endphp
    <div id="act-{{$row->id}}" class="act odd">
        <div class="col-4 col-md-1 fl"><div class="row">{{$row->activity_code}}</div></div>
        <div class="col-7 col-md-3 fl">{{$row->activity_name}}<br /><span class="group-label">{{$row->groupName}}</span></div>
        <div class="col-8 col-md-5 fl">{{substr($row->activity_desc, 0, 250).$ext}}</div>
        <div class="col-2 col-md-2 fl">
        <label class="custom-switch">
           {{Form::checkbox('status',1,$checked,['id'=>'act-status-'.$row->id,'class'=>'custom-switch-input act-status-btn'])}}
           <span class="custom-switch-indicator"></span><span class="custom-switch-description" id="actSL-{{$row->id}}">{{$active}}</span>
       </label>
        </div>
        <div class="col-2 col-md-1 fl"><div class="row">
            {{Form::hidden('act_name', $row->activity_name, ['id'=>'act_name-'.$row->id])}}
            {{Form::hidden('act_desc', $row->activity_desc, ['id'=>'act_desc-'.$row->id])}}
            {{Form::hidden('act_status', $row->active, ['id'=>'act_status-'.$row->id])}}
            {{Form::hidden('act_msId', $row->ms_id, ['id'=>'act_msId-'.$row->id])}}
            <div class="fl link"><i id="{{$row->id}}" title="View Media" class="edit-media fa fa-image"></i></div>
            <div class="fl link"><i id="{{$row->id}}" title="Edit Activity" class="edit-act fa fa-edit"></i></div>
            <div class="fl link"><i id="{{$row->id}}" class="del-act fa fa-trash">&nbsp;</i></div>
        </div></div>
        <div class="clr"></div>
    </div>
    @endforeach
@else
    <div class="no-rec-container"> <div class="no-record tac">No records found.</div> </div>
@endif




