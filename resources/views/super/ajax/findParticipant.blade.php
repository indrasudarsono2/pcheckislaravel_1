<table class="table table-striped table-bordered table-hover">
  <thead>
    <tr>
      <td width="10px" align="center" scope="col"><b>No</b></td>
      <td width="200px" align="center" scope="col"><b>License Number</b></td>
      <td width="200px" align="center" scope="col"><b>Name</b></td>
      <td width="200px" align="center" scope="col"><b>Remark</b></td>
      <td width="200px" align="center" scope="col"><b>Action</b></td>
    </tr>
  </thead>
  <tbody>
    @foreach ($user as $u)
    <tr>
      <td align="center">{{ $loop->iteration }}</th>
      <td align="center">{{ $u->id }}</td>
      <td align="left">{{ $u->name}}</td>
      <td align="center">{{ $u->remark->remark }}</td>
      <td align="center">
        <a href="/user/{{ $u->id }}/edit" class="btn btn-success fas fa-edit"> Edit</a>
        <form action="/user/{{ $u->id }}" method="post" class="d-inline">
          @method('delete')
          @csrf
        <button type="submit" class="btn btn-danger fas fa-trash" onclick="return confirm('Are you sure want to delete this data?')"> 
          Delete</button>
        </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>