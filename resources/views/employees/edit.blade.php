<!DOCTYPE html>
<html>
<head>
<title>Edit Employee</title>

<style>

body{
font-family:Arial;
background:#f4f6f9;
padding:40px;
}

.container{
width:500px;
margin:auto;
background:white;
padding:30px;
border-radius:8px;
box-shadow:0 2px 6px rgba(0,0,0,0.1);
}

h2{
margin-bottom:20px;
text-align:center;
}

input, select{
width:100%;
padding:10px;
margin-bottom:15px;
border:1px solid #ccc;
border-radius:5px;
}

button{
background:#3498db;
color:white;
border:none;
padding:10px;
width:100%;
border-radius:5px;
cursor:pointer;
}

button:hover{
background:#2980b9;
}

.back{
display:block;
margin-top:15px;
text-align:center;
text-decoration:none;
color:#555;
}

</style>

</head>

<body>

<div class="container">

<h2>Edit Employee</h2>

<form action="{{ route('employees.update',$employee->id) }}" method="POST">

@csrf
@method('PUT')

<label>Name</label>
<input type="text" name="name" value="{{ $employee->name }}" required>

<label>Email</label>
<input type="email" name="email" value="{{ $employee->email }}" required>

<label>Department</label>
<select name="department">

<option value="IT" {{ $employee->department=='IT' ? 'selected':'' }}>IT</option>

<option value="HR" {{ $employee->department=='HR' ? 'selected':'' }}>HR</option>

<option value="Finance" {{ $employee->department=='Finance' ? 'selected':'' }}>Finance</option>

<option value="Marketing" {{ $employee->department=='Marketing' ? 'selected':'' }}>Marketing</option>

</select>

<label>Salary</label>
<input type="number" name="salary" value="{{ $employee->salary }}" required>

<button type="submit">Update Employee</button>

</form>

<a class="back" href="{{ route('employees.index') }}">← Back to Employees</a>

</div>

</body>
</html>