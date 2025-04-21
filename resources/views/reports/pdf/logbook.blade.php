<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Logbook</title>
</head>

<body>
    <div style="margin-top: -30px">
        <center>
            <img src="{{ public_path('dist/img/logbookheader.jpg') }}" alt="" width="50%" height="150px">
        </center>
    </div>

    <div>
        <hr style="border: 1px solid black;">
    </div>

    <div>
        <center>
            <h1>BORROWER INVENTORY LOGBOOK</h1>
        </center>
    </div>
    <div>
        <table style="border: 1px solid black; border-collapse: collapse; width: 100%;">
            <thead>
                <tr>
                    <th style="border: 1px solid black; padding: 15px; font-size: 20px; font-family: Arial;">Date</th>
                    <th style="border: 1px solid black; padding: 15px; font-size: 20px; font-family: Arial;">Time</th>
                    <th style="border: 1px solid black; padding: 15px; font-size: 20px; font-family: Arial;">Full Name</th>
                    <th style="border: 1px solid black; padding: 15px; font-size: 20px; font-family: Arial;">ID</th>
                    <th style="border: 1px solid black; padding: 15px; font-size: 20px; font-family: Arial;">Remarks</th>
                </tr>
            </thead>
            <tbody>
               @foreach($elogs as $dataelogs)
                    <tr>
                         <td style="border: 1px solid black; width: 20%; padding: 10px; height: 10px;">{{ $dataelogs->dateborrowed }}</td>
                          <td style="border: 1px solid black; width: 20%; padding: 10px; height: 10px;">{{ $dataelogs->created_at->format('h:i:s A') }}</td>
                         <td style="border: 1px solid black; width: 20%; padding: 10px; height: 10px;">{{ $dataelogs->fname }} {{ $dataelogs->mname }} {{ $dataelogs->lname }}</td>
                         <td style="border: 1px solid black; width: 20%; padding: 10px; height: 10px;"></td>
                         <td style="border: 1px solid black; width: 20%; padding: 10px; height: 10px;">{{ $dataelogs->stat }}</td>
                    </tr>
               @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
