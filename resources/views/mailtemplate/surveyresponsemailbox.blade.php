<!DOCTYPE html>

<html>
<head>
    <meta charset="UTF-8">
    <title>Survey Response Links</title>
    <style type="text/css">
        body {
            font-family: Arial, sans-serif;
            font-size: 13px;
            color: #333;
            padding: 30px;
            margin: 0;
            background-color: #f8f8f8;
        }
        .header {
            margin-bottom: 20px;
        }
        .card {
            background: #ffffff;
            border-radius: 8px;
            padding: 20px;
            margin-top: 15px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }
        .card-body {
            text-align: justify;
            line-height: 1.6;
        }
        .details {
            margin: 0 0 15px 0;
            padding: 0;
            list-style: none;
        }
        .details li {
            margin-bottom: 6px;
        }
        .list-unstyled {
            list-style: none;
            padding: 0;
            margin: 10px 0 0 0;
        }
        .list-unstyled li {
            margin-bottom: 8px;
        }
        a {
            color: #0066cc;
            text-decoration: none;
            word-break: break-all;
        }
        a:hover {
            text-decoration: underline;
        }
        .footer {
            margin-top: 25px;
        }
    </style>
</head>
<body>


    <section class="header">
        <p><strong>Dear Survey Response Collector,</strong></p>
        <p>
            We hope this message finds you well. Please find below the details and access links to the
            submitted responses for your assigned survey.
        </p>
    </section>

    <section>
        <div class="card">
            <div class="card-body">
                <h4 style="margin-top: 0; color: #333;">Survey Information</h4>
                <ul class="details">
                    <li><strong>Survey Title:</strong> {{ $data["form"]->title }}</li>
                    {{-- <li><strong>Survey Category:</strong> {{ $data["form"]->category->name ?? 'N/A' }}</li> --}}
                    <li><strong>Created By:</strong> {{ $data["form"]->user_id->name ?? 'System Administrator' }}</li>
                    <li><strong>Date Created:</strong> {{ $data["form"]->created_at->format('F d, Y') }}</li>
                    <li><strong>Total Responses:</strong> {{ $data["form"]->responderlinks->count() }}</li>
                </ul>

                <hr style="border: none; border-top: 1px solid #ddd; margin: 15px 0;">

                <h4 style="color: #333;">Response Access Links</h4>
                <p>You may view each detailed response by following the links below:</p>

                <ul class="list-unstyled">
                    @foreach($data["form"]->responderlinks as $index => $responderlink)
                        <li>
                            <strong>Response {{ $index + 1 }}:</strong>
                            <a href="{{ $responderlink->url }}" target="_blank">{{ $responderlink->url }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </section>

    <section class="footer">
        <p>If you encounter any difficulties accessing the above links or have further questions, please contact the survey administrator.</p>
        <p>
            Thank you for your continued participation and support.
        </p>
        <ul class="list-unstyled">
            <li>Best Regards,</li>
            <li><strong>{{ config('app.name') }}</strong></li>
        </ul>
    </section>

</body>
</html>
