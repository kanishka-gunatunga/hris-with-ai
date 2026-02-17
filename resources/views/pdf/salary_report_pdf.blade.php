<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top:20px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        th { background: #f2f2f2; font-weight: bold; }
        h2 { text-align:center; margin-bottom:0; }
        .sub { text-align:center; margin-top:0; }
    </style>
</head>
<body>

<h2>Salary Report</h2>
<p class="sub">Month: {{ $yearMonth }}</p>

<table>
    <thead>
        <tr>
            <th>Employee Name</th>
            <th>EPF No</th>
            <th>Basic Salary</th>
            <th>Total Deductions</th>
            <th>Total Allowances</th>
            <th>Net Salary</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $row)
        <tr>
            <td>{{ $row['employee_name'] }}</td>
            <td>{{ $row['epf_no'] }}</td>
            <td>{{ number_format($row['basic_salary'],2) }}</td>
            <td>{{ number_format($row['total_deductions'],2) }}</td>
            <td>{{ number_format($row['total_allowances'],2) }}</td>
            <td>{{ number_format($row['net_salary'],2) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
