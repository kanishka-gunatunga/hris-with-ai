<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        h2 { text-align: center; margin: 0; padding: 0; }
        .section-title { margin-top: 20px; font-weight: bold; font-size: 16px; }
    </style>
</head>
<body>

<h2>Leave Report</h2>
<p>From: <b>{{ $startDate }}</b> To: <b>{{ $endDate }}</b></p>

<div class="section-title">Leave Details</div>
<table>
    <thead>
        <tr>
            <th>Employee Name</th>
            <th>EPF No</th>
            <th>Leave Type</th>
        </tr>
    </thead>
    <tbody>
        @foreach($leave_data as $row)
        <tr>
            <td>{{ $row['employee'] }}</td>
            <td>{{ $row['epf'] }}</td>
            <td>{{ $row['type'] }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="section-title">Total Leave Count</div>

<table>
    <thead>
        <tr>
            <th>Employee Name</th>
            <th>EPF No</th>
            <th>Total Leaves</th>
        </tr>
    </thead>
    <tbody>
        @foreach($leave_summary as $row)
        <tr>
            <td>{{ $row['employee'] }}</td>
            <td>{{ $row['epf'] }}</td>
            <td>{{ $row['total'] }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
