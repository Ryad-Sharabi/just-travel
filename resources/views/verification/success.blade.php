<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>{{ $title ?? 'Email verified' }}</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  @if(!empty($autoredirect_seconds) && !empty($cta_url))
    <meta http-equiv="refresh" content="{{ (int)$autoredirect_seconds }};url={{ $cta_url }}">
  @endif
  <style>
    :root{
      --bg1:#0f172a; --bg2:#1e293b; --ok:#22c55e; --txt:#e5e7eb; --muted:#cbd5e1; --card:#ffffff1a; --border:#94a3b8;
      --shadow:0 10px 30px rgba(0,0,0,.25);
    }
    *{box-sizing:border-box} html,body{height:100%;margin:0;font-family:system-ui,-apple-system,Segoe UI,Roboto,Ubuntu,"Helvetica Neue",Arial}
    body{
      background: radial-gradient(1200px 600px at 10% -10%, #334155, transparent 60%),
                  linear-gradient(160deg, var(--bg1), var(--bg2));
      color: var(--txt);
      display:flex; align-items:center; justify-content:center; padding:24px;
    }
    .card{
      width:min(640px, 92vw);
      background: var(--card);
      backdrop-filter: blur(10px);
      -webkit-backdrop-filter: blur(10px);
      border:1px solid var(--border);
      border-radius:20px; padding:28px; box-shadow:var(--shadow);
    }
    .icon{
      width:62px;height:62px;border-radius:50%;
      display:grid;place-items:center;margin-bottom:14px;
      background:#16a34a22;border:1px solid #22c55e66;color:var(--ok);
      font-size:30px;
    }
    h1{margin:0 0 10px;font-weight:800;line-height:1.15}
    p{margin:0 0 20px;color:var(--muted)}
    .actions{display:flex;gap:12px;flex-wrap:wrap}
    .btn{
      appearance:none;border:0;border-radius:12px;padding:12px 16px;
      background: var(--ok); color:#06210f; font-weight:700; cursor:pointer; text-decoration:none;
      box-shadow: 0 6px 20px rgba(34,197,94,.35);
    }
    .btn:active{transform:translateY(1px)}
    .sub{font-size:13px;color:#a8b0bb}
  </style>
</head>
<body>
  <main class="card" role="main" aria-labelledby="title">
    <div class="icon" aria-hidden="true">✓</div>
    <h1 id="title">{{ $heading ?? 'Congratulations — your email verified successfully' }}</h1>
    <p>{{ $message ?? 'You can safely close this page and continue in the app.' }}</p>
    <div class="actions">
      @if(!empty($cta_url))
        <a class="btn" href="{{ $cta_url }}">{{ $cta_txt ?? 'Open the app' }}</a>
      @endif
    </div>
    @if(!empty($autoredirect_seconds) && !empty($cta_url))
      <p class="sub">You will be redirected automatically in {{ (int)$autoredirect_seconds }}s…</p>
    @endif
  </main>
    @include('partials.whatsapp-button')
</body>
</html>
