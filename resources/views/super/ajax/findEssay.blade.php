<table class="table table-striped table-bordered table-hover">
  <thead>
    <tr>
      <td width="10px" align="center" scope="col"><b>No</b></td>
      <td width="10px" align="center" scope="col"><b>ID</b></td>
      <td width="10px" align="center" scope="col"><b>Group</b></td>
      <td width="200px" align="center" scope="col"><b>Essay</b></td>
      <td width="200px" align="center" scope="col"><b>Answer</b></td>
      <td width="10px" align="center" scope="col"><b>Score</b></td>
      <td width="50px" align="center" scope="col"><b>Action</b></td>
    </tr>
  </thead>
  <tbody>
    @foreach ($essay as $essay)
    <tr>
      <td align="center">{{ $loop->iteration }}</td>
      <td align="center">{{ $essay->id }}</td>
        @if($essay->essay_group_id=="")
        <td align="center"></td>            
      @else
        <td align="center">{{ $essay->essay_group->group }}</td>
      @endif
      <td align="left">{{ $essay->essay }}</td>
      <td align="left">{{ $essay->answer }}</td>
      <td align="center">{{ $essay->score }}</td>
      <td align="center">
        <a href="{{ route('aplication_ratings.essays.edit', [$aplication_rating,$essay]) }}" class="btn btn-success fas fa-edit"></a>
        <form action="{{ route('aplication_ratings.essays.destroy', [$aplication_rating, $essay]) }}" method="post" class="d-inline">
          @method('delete')
          @csrf
        <button type="submit" class="btn btn-danger fas fa-trash" onclick="return confirm('Are you sure want to delete this data?')"> 
        </button>
        </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
