
<div>
    <table id="reg_courses" class="reg_courses-table table table-striped table-bordered w-100 text-nowrap">
        <thead>
            <tr>
                <th class="wd-15p notexport">Select</th>
                <th class="wd-15p">Course Code</th>
                <th class="wd-15p">Course Name</th>
                <th class="wd-20p">Student</th>
                <th class="wd-10p">Location</th>
                <th class="wd-15p">Registered On</th>
                <th class="wd-10p">Closing Date</th>
                <th class="wd-10p">Status</th>
                <th class="wd-25p text-center notexport action-btn">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($courses) {
                $slno = 1;
                foreach ($courses as $course) {?>
                    <tr class="dtrow" id="dtrow-<?php echo $course->regId; ?>">
                        <td></td>
                        <td><?php echo $course->course_code; ?></td>
                        <td><?php echo $course->course_name; ?></td>
                        <td><?php echo $course->name; ?></td>
                        <td><?php echo $course->location; ?></td>
                        <td>{{date("d M Y",strtotime($course->registered_at))}}</td> 
                        <td>{{date("d M Y",strtotime($course->closing_date))}}</td>
                        <td><?php echo $course->status_name; ?></td>
                        <td class="text-center">
                            <a href="{{url('/admin/registered/course/'.$course->regId)}}" id="courseViewBtn-{{$course->id}}" class="btn btn-sm btn-info viewBtn"><i class="fa fa-eye"></i> View</a>
                            <button id="courseDelBtn-<?php echo $course->regId; ?>" class="btn btn-sm btn-danger btn-delete courseDelBtn"><i class="fa fa-trash"></i> Delete</button>
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
                <th class="wd-20p">Student</th>
                <th class="wd-10p">Location</th>
                <th class="wd-15p">Registered On</th>
                <th class="wd-10p">Closing Date</th>
                <th class="wd-20p">Status</th>
                <th class="wd-25p text-center action-search"></th>
            </tr>
        </tfoot>
    </table>
    {{ csrf_field() }}
    <input type="hidden" name="baseurl" id="baseurl" value="<?php echo $app->make('url')->to('/'); ?>">
</div>
<script src="{{asset('public/bizzadmin/assets/js/datatable/reg_courses-datatable.js')}}"></script>
