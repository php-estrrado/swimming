@if(count($groups) > 0)
    @foreach($groups as $k=>$group)  
        @php
            if($group->active == 1){ $grActive = "Active"; $gCkd = true; }else{ $grActive = "Inactive"; $gCkd = false; } 
            $grActivities   =   $group->activities;
        @endphp
        <div class="act-group">
            <div id="group-{{$group->id}}" class="gr-container">
                <div id="gr-title-{{$group->id}}" data-toggle="off" class="gr-title" onclick="openGrTab(this)">
                    <div class="col-12 col-md-9 fl">{{$group->group_name}}</div>
                    <div class="col-6 col-md-2 fl">
                        <label class="custom-switch">
                            {{Form::checkbox('active',1,$gCkd,['id'=>'gr-active-'.$group->id,'class'=>'custom-switch-input gr-status-btn'])}}
                            <span class="custom-switch-indicator"></span><span class="custom-switch-description" id="grSL-{{$group->id}}">{{$grActive}}</span>
                        </label>
                    </div>
                    <div class="col-6 col-md-1 fr">
                        <div class="fl link"><i id="{{$group->id}}" data-id="{{$group->ms_id}}" data-name="{{$group->group_name}}" data-status="{{$group->active}}" title="Edit Group" class="edit-group fa fa-edit"></i></div>
                        <div class="fl link"><i id="{{$group->id}}" title="Delete Group" class="del-group fa fa-trash"></i></div>
                    </div>
                    <div class="clr"></div>
                </div>

                <div id="gr-content-{{$group->id}}" class="gr-content" style="display: none;">
                    @include('admin.pages.courses.details.assigned_group_activities')
                 </div>
            </div>
        </div>
    @endforeach
@endif
    
  