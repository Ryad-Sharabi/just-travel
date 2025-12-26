<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>{{ $title ?? 'Invalid verification link' }}</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    body{margin:0;height:100%;display:flex;align-items:center;justify-content:center;background:#0b1320;color:#e5e7eb;font-family:system-ui,Segoe UI,Roboto}
    .card{width:min(640px,92vw);background:#ff00001a;backdrop-filter:blur(8px);-webkit-backdrop-filter:blur(8px);border:1px solid #ef444455;border-radius:20px;padding:28px}
    .icon{width:56px;height:56px;border-radius:50%;display:grid;place-items:center;margin-bottom:14px;background:#7f1d1d;color:#ef4444;border:1px solid #ef444466;font-size:26px}
    h1{margin:0 0 10px;font-weight:800}
    p{margin:0 0 20px;color:#fecaca}
    a.btn{display:inline-block;background:#ef4444;color:#fff;padding:12px 16px;border-radius:12px;text-decoration:none;font-weight:700}
  </style>
</head>
<body>
  <main class="card">
    <div class="icon">×</div>
    <h1>{{ $heading ?? 'Verification link is not valid' }}</h1>
    <p>{{ $message ?? 'The link might be expired or malformed. Please request a new verification email.' }}</p>
    @if(!empty($cta_url))
      <a class="btn" href="{{ $cta_url }}">{{ $cta_txt ?? 'Back to home' }}</a>
    @endif
  </main>
    @include('partials.whatsapp-button')
</body>
</html>
