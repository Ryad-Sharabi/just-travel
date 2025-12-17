<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>{{ $title ?? 'Email already verified' }}</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    body{margin:0;height:100%;display:flex;align-items:center;justify-content:center;background:#0f172a;color:#e5e7eb;font-family:system-ui,Segoe UI,Roboto}
    .card{width:min(640px,92vw);background:#ffffff1a;backdrop-filter:blur(10px);-webkit-backdrop-filter:blur(10px);border:1px solid #94a3b8;border-radius:20px;padding:28px}
    .icon{width:56px;height:56px;border-radius:50%;display:grid;place-items:center;margin-bottom:14px;background:#334155;color:#fbbf24;border:1px solid #fbbf2444;font-size:26px}
    h1{margin:0 0 10px;font-weight:800}
    p{margin:0 0 20px;color:#cbd5e1}
    a.btn{display:inline-block;background:#64748b;color:#0b1220;padding:12px 16px;border-radius:12px;text-decoration:none;font-weight:700}
  </style>
</head>
<body>
  <main class="card">
    <div class="icon">!</div>
    <h1>{{ $heading ?? 'Your email is already verified' }}</h1>
    <p>{{ $message ?? 'You can sign in and continue.' }}</p>
    @if(!empty($cta_url))
      <a class="btn" href="{{ $cta_url }}">{{ $cta_txt ?? 'Go to app' }}</a>
    @endif
  </main>
</body>
</html>
