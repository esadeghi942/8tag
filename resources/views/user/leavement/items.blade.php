<tr>
    <td>{{  $leavement->id  }}</td>
    <?php
    $text='';
    if($leavement->type == 1){
        $text='روزانه';
    }
    if($leavement->type == 2){
        $text='ساعتی';
    }
    ?>
    <td>{{ $text }}</td>
    <td>{{  $leavement->start }}</td>
    <td>{{  $leavement->finish }}</td>
    <td>{{  $leavement->date_count }}</td>
    <td>{{  $leavement->description }}</td>
    <?php
    $class='bg-warning';
    $text='در حال بررسی';
    if($leavement->status == 1){
        $class='bg-danger';
        $text='رد شده';
    }
    elseif($leavement->status == 2){
        $class='bg-success';
        $text='تایید شده';
    }
    ?>
    <td><span class="badge {{$class}}">{{  $text }}</span></td>
    <td>
        <a href="{{ route('user.leavement.edit',[$leavement->id])  }}"><i class="fa fa-edit"></i></a>
        <a href="{{ route('user.leavement.delete',[$leavement->id])  }}"><i class="fa fa-trash"></i></a>
    </td>

</tr>