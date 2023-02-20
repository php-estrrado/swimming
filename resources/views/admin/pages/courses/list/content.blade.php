
<div>
    <table id="course" class="course-table table table-striped table-bordered w-100 text-nowrap">
        <thead>
            <tr>
                <th class="wd-15p notexport">Select</th>
                <th class="wd-15p">Course Code</th>
                <th class="wd-15p">Course Name</th>
                <th class="wd-20p">Coach</th>
                <th class="wd-10p">Location</th>
                <th class="wd-15p">Start Date</th>
<!--                <th class="wd-20p">End Date</th>-->
                <th class="wd-10p">Closing Date</th>
                <th class="wd-10p">Status</th>
                <th class="wd-25p text-center notexport action-btn">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($courses) {
                $slno = 1;
                foreach ($courses as $course) {

                    $na = "N/A";
                    if ($course->active == 1) {
                        $active = "Active";
                        $checked = 'checked="checked"';
                    } else if ($course->active == 0){ 
                        $active = "Inactive";
                        $checked = "";
                    }
                    ?>
                    <tr class="dtrow" id="dtrow-<?php echo $course->id; ?>">
                        <td></td>
                        <td><?php echo $course->course_code; ?></td>
                        <td><?php echo $course->course_name; ?></td>
                        <td><?php echo $course->name; ?></td>
                        <td><?php echo $course->location; ?></td>
                        <td><?php echo $course->start_date; ?></td>
<!--                        <td><?php echo $course->end_date; ?></td>-->
                        <td><?php echo $course->closing_date; ?></td>
                        <td>
                            <label class="custom-switch">
                                <input id="status-<?php echo $course->id; ?>" type="checkbox" name="option" value="1" class="custom-switch-input status-btn" <?php echo $checked; ?>>
                                <span class="custom-switch-indicator"></span>
                                <span class="custom-switch-description" id="csd-<?php echo $course->id; ?>">
                                    <?php echo $active; ?>
                                </span>
                            </label>
                        </td>
                        <td class="text-center">
                            <a href="{{url('/admin/course/'.$course->id)}}" id="courseEditBtn-{{$course->id}}" class="btn btn-sm btn-primary btn-edit editBtn"><i class="fa fa-edit"></i> Edit</a>
                            <button id="courseDelBtn-<?php echo $course->id; ?>" class="btn btn-sm btn-danger btn-delete courseDelBtn"><i class="fa fa-trash"></i> Delete</button>
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
                <th class="wd-15p">Course Code</th>
                <th class="wd-15p">Course Name</th>
                <th class="wd-20p">Coach</th>
                <th class="wd-10p">Location</th>
                <th class="wd-15p">Start Date</th>
<!--                <th class="wd-20p">End Date</th>-->
                <th class="wd-10p">Closing Date</th>
                <th class="wd-20p">Status</th>
                <th class="wd-25p text-center action-search"></th>
            </tr>
        </tfoot>
    </table>
    {{ csrf_field() }}
    <input type="hidden" name="baseurl" id="baseurl" value="<?php echo $app->make('url')->to('/'); ?>">
</div>
<script src="{{asset('public/bizzadmin/assets/js/datatable/course-datatable.js')}}"></script>
