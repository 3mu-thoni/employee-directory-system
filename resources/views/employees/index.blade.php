<!DOCTYPE html>
<head>
<title>Employee Directory</title>

<style>

body{
font-family: Arial;
background:#f4f6f9;
padding:30px;
}

.container{
width:85%;
margin:auto;
}

h1{
margin-bottom:20px;
}

.dashboard{
display:flex;
gap:15px;
margin-bottom:30px;
}

.card{
background:white;
padding:15px;
flex:1;
text-align:center;
border-radius:8px;
box-shadow:0 2px 4px rgba(0,0,0,0.1);
}
.card{
padding:15px;
flex:1;
text-align:center;
border-radius:8px;
color:white;
font-weight:bold;
}

.card-total{
background:#3498db;
}

.card-salary{
background:#2ecc71;
}

.card-high{
background:#9b59b6;
}

.card-low{
background:#e74c3c;
}

.card-average{
background:#f39c12;
}

table{
width:100%;
border-collapse:collapse;
background:white;
}

th{
background:#2c3e50;
color:white;
padding:10px;
}

td{
padding:10px;
border-bottom:1px solid #ddd;
}

.filter-bar{
margin-bottom:20px;
display:flex;
gap:10px;
}

button{
background:#3498db;
border:none;
color:white;
padding:8px 12px;
cursor:pointer;
border-radius:4px;
}

.reset{
background:#e74c3c;
}

.top-row{
background:#eaffea;
font-weight:bold;

}
.edit-btn{
background:#3498db;
color:white;
border:none;
padding:6px 10px;
border-radius:4px;
cursor:pointer;
}

.delete-btn{
background:#e74c3c;
color:white;
border:none;
padding:6px 10px;
border-radius:4px;
cursor:pointer;
margin-left:5px;
}
.pagination{
display:flex;
justify-content:center;
margin-top:25px;
}

.pagination ul{
display:flex;
gap:6px;
list-style:none;
padding:0;
margin:0;
}

.page-item{
list-style:none;
}

.page-link{
display:block;
padding:8px 14px;
border-radius:6px;
border:1px solid #ddd;
color:#333;
text-decoration:none;
background:white;
font-weight:500;
}

.page-link:hover{
background:#f2f2f2;
}

.page-item.active .page-link{
background:#3498db;
color:white;
border-color:#3498db;
}

.page-item.disabled .page-link{
color:#aaa;
background:#f8f8f8;
}

</style>
</head>

<body>

<div class="container">

<h1>Employee Directory</h1>

<!-- Dashboard -->
<div class="dashboard">

<div class="card card-total">
<h3>Total Employees</h3>
<p>{{ $totalEmployees }}</p>
</div>

<div class="card card-salary">
<h3>Total Salary</h3>
<p>{{ number_format($totalSalary) }}</p>
</div>

<div class="card card-high">
<h3>Highest Salary</h3>
<p>{{ $highestSalary }}</p>
</div>

<div class="card card-low">
<h3>Lowest Salary</h3>
<p>{{ $lowestSalary }}</p>
</div>

<div class="card card-average">
<h3>Average Salary</h3>
<p>{{ number_format($averageSalary,2) }}</p>
</div>

</div>



<!-- Filters -->

<form method="GET" action="{{ route('employees.index') }}" class="filter-bar">

<input type="text" name="search"
placeholder="Search name..."
value="{{ request('search') }}">

<select name="department">

<option value="">All Departments</option>

<option value="IT" {{ request('department')=='IT' ? 'selected' : '' }}>IT</option>

<option value="HR" {{ request('department')=='HR' ? 'selected' : '' }}>HR</option>

<option value="Finance" {{ request('department')=='Finance' ? 'selected' : '' }}>Finance</option>

<option value="Marketing" {{ request('department')=='Marketing' ? 'selected' : '' }}>Marketing</option>

</select>

<select name="sort">

<option value="">Sort Salary</option>

<option value="salary_asc" {{ request('sort')=='salary_asc'?'selected':'' }}>
Salary Low → High
</option>

<option value="salary_desc" {{ request('sort')=='salary_desc'?'selected':'' }}>
Salary High → Low
</option>

</select>

<button type="submit">Apply</button>

<a href="{{ route('employees.index') }}">
<button type="button" class="reset">Reset</button>
</a>

</form>


<!-- Employee Table -->

<table>

<tr>
 <th>Id</th>
<th>Name</th>
<th>Email</th>
<th>Department</th>
<th>Salary</th>
<th>Date Created</th>
<th>Actions</th>


</tr>

@foreach($employees as $employee)

<tr class="{{ $employee->salary == $highestSalary ? 'top-row' : '' }}">


<td>{{ $employee->id }}</td>
<td>{{ $employee->name }}</td>
<td>{{ $employee->email }}</td>
<td>{{ $employee->department }}</td>
<td>{{ $employee->salary }}</td>
<td>{{ $employee->created_at->format('Y-m-d') }}</td>
<td>

<a href="{{ route('employees.edit',$employee->id) }}">
<button class="edit-btn">Edit</button>
</a>

<form action="{{ route('employees.destroy',$employee->id) }}" method="POST" style="display:inline;">
@csrf
@method('DELETE')

<button class="delete-btn" onclick="return confirm('Delete this employee?')">
Delete
</button>

</form>

</td>

</tr>


@endforeach

</table>

<br>

<div class="pagination">
    {{ $employees->links('pagination::bootstrap-5') }}
</div>


<h2>Top 5 Highest Paid Employees</h2>

<table>

<tr>
<th>Name</th>
<th>Salary</th>
</tr>

@foreach($topEarners as $top)

<tr>
<td>{{ $top->name }}</td>
<td>{{ $top->salary }}</td>
</tr>

@endforeach

</table>

</div>

</body>
</html>