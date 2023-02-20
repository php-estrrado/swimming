<div>
    <table id="badge" class="badge-table table table-striped table-bordered w-100 text-nowrap">
        <thead>
            <tr>
                <th class="wd-15p notexport">Select</th>
                <th class="wd-15p">ID</th>
                <th class="wd-15p">Title</th>
                <th class="wd-20p">Description</th>
                <th class="wd-10p">Badge</th>
                <th class="wd-10p">Status</th>
                <th class="wd-25p text-center notexport action-btn">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($badges) {
                $slno = 1;
                foreach ($badges as $badge) {

                    $na = "N/A";
                    if ($badge->active == 1) {
                        $active = "Active";
                        $checked = 'checked="checked"';
                    } else if ($badge->active == 0) {
                        $active = "Inactive";
                        $checked = "";
                    }
                    ?>
                    <tr class="dtrow" id="dtrow-<?php echo $badge->id; ?>">
                        <td></td>
                        <td><?php echo $badge->id; ?></td>
                        <td><?php echo $badge->title; ?></td>
                        <td><?php echo $badge->description; ?></td>
                        <td><div class="img"><img src="{{url('/storage'.$badge->badge_img)}}" alt="Badge Image" title="Badge Image" height="50" /></div></td>
                        <td>
                            <label class="custom-switch">
                                <input id="status-<?php echo $badge->id; ?>" type="checkbox" name="option" value="1" class="custom-switch-input status-btn" <?php echo $checked; ?>>
                                <span class="custom-switch-indicator"></span>
                                <span class="custom-switch-description" id="csd-<?php echo $badge->id; ?>">
                                    <?php echo $active; ?>
                                </span>
                            </label>
                        </td>
                        <td class="text-center">
                            {{Form::hidden('title-'.$badge->id,$badge->title,['id'=>'title-'.$badge->id])}}{{Form::hidden('desc-'.$badge->id,$badge->description,['id'=>'desc-'.$badge->id])}}
                            {{Form::hidden('img-'.$badge->id,url('/storage'.$badge->badge_img),['id'=>'img-'.$badge->id])}}{{Form::hidden('active-'.$badge->id,$badge->active,['id'=>'active-'.$badge->id])}}
                            <button id="badgeEditBtn-<?php echo $badge->id; ?>" class="btn btn-sm btn-primary btn-edit badgeEditBtn"><i class="fa fa-edit"></i> Edit</button>
                            <button id="badgeDelBtn-<?php echo $badge->id; ?>" class="btn btn-sm btn-danger btn-delete badgeDelBtn"><i class="fa fa-trash"></i> Delete</button>
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
                <th class="wd-15p">Title</th>
                <th class="wd-20p">Description</th>
                <th class="wd-10p text-center action-search"></th>
                <th class="wd-10p text-center action-search"></th>
                <th class="wd-25p text-center action-search"></th>
            </tr>
        </tfoot>
    </table>
    {{ csrf_field() }}
    <input type="hidden" name="baseurl" id="baseurl" value="<?php echo $app->make('url')->to('/'); ?>">
</div>
<script src="{{asset('public/bizzadmin/assets/js/datatable/badge-datatable.js')}}"></script>
