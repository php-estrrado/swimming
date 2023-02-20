@if(count($groups) > 0)
    @foreach($groups as $k=>$group)  
        @php
            if($group->active == 1){ $grActive = "Active"; $gCkd = true; }else{ $grActive = "Inactive"; $gCkd = false; } 
            $grActivities   =   $group->activities;
        @endphp
        <div class="act-group">
            <div id="group-{{$group->id}}" class="gr-container">
                <div id="gr-title-{{$group->id}}" data-toggle="off" class="gr-title" onclick="openGrTab(this)">
                    <div class="col-12">{{$group->group_name}}</div>
                    <div class="clr"></div>
                </div>
                <div id="gr-content-{{$group->id}}" class="gr-content" style="display: none;">
                    @include('coach.pages.courses.details.assigned_group_activities')
                    
                 </div>
            </div>
        </div>
    @endforeach
@endif
    
  