<!DOCTYPE html>
<html>
<head>
    <title>Attendance Report</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #444; padding: 6px; text-align: left; }
        th { background: #e8e8e8; }
        h2 { margin-bottom: 5px; }
    </style>
</head>

<body>

<h2>Attendance Report</h2>
<p><strong>Employee:</strong> {{ $employee_name }}</p>
<p><strong>From:</strong> {{ $start }} &nbsp;&nbsp; <strong>To:</strong> {{ $end }}</p>

<table>
    <thead>
        <tr>
            <th>Check-In / Check-Out</th>
            <th>Date</th>
            <th>Time</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($attendance_list as $att)
            <tr>
                <td>{{ $att->check_in_or_out }}</td>
                <td>{{ $att->year_month_date }}</td>
                <td>{{ $att->time_ }}</td>
            </tr>
        @endforeach
    </tbody>

</table>

</body>
</html>
