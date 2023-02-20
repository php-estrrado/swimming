<style> table td{ padding: 7px; }</style>

<div style="width:auto; margin: 30px auto;">
   <table>
       <thead>
           <tr>
               <th>Name</th><th>Phone</th><th>Email</th>
           </tr>
       </thead>
       <tbody>
           @if($response && count($response) > 0)
                @foreach($response as $row)
                    <tr>
                        <td>{{$row->name}}</td><td>{{$row->phone}}</td><td>{{$row->email}}</td>
                    </tr>
                @endforeach
           @endif
       </tbody>
   </table> 
</div>
