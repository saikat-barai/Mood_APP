<!DOCTYPE html>
<html>

<head>
    <title>Monthly Mood List</title>
</head>

<body style="font-family: Arial, sans-serif; background: #f8f9fa; padding: 40px;">

    <div
        style="max-width: 500px; margin: auto; background: white; padding: 30px; border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">

        <h3 style="text-align: center; margin-bottom: 25px; color: #333;">YOUR MONTHLY MOOD LIST</h3>

        <table style="width: 100%; border-collapse: collapse; margin-bottom: 30px;">
            <thead>
                <tr>
                    <th style="text-align: left; padding: 12px 0; font-size: 14px; color: #555;">YOU'S MOOD</th>
                    <th style="text-align: right; padding: 12px 0; font-size: 14px; color: #555;">COUNT</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($moodCounts as $mood => $count)
                <tr>
                    <td style="padding: 10px 0; color: #333;">{{ $mood }}</td>
                    <td style="padding: 10px 0; text-align: right;">
                        <span
                            style="background-color: #ff3b6f; color: white; padding: 5px 12px; border-radius: 15px; font-size: 13px;">{{ $count }}</span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div
            style="background-color: #e3f9f7; padding: 15px; text-align: center; border-radius: 8px; font-size: 16px; color: #155e75;">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 36 36"
                style="vertical-align: middle;">
                <path fill="#FFD93B"
                    d="M18 2l3.09 9.51H31l-7.55 5.49 2.88 9.51L18 21.51 9.67 26.51 12.55 17 5 11.51h9.91L18 2z" />
            ***</svg> <strong>Mood Of The Last 30 Days</strong>***
            <div style="margin-top: 6px; font-size: 18px; color: #29c736; font-weight: bold;"><strong>{{ $moodOfMonth }}</strong></div>
        </div>
    </div>

</body>

</html>
