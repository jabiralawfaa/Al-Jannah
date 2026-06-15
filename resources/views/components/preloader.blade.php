<div id="page-preloader" style="position:fixed;inset:0;z-index:99999;background:#0f1a17;display:flex;flex-direction:column;align-items:center;justify-content:center;transition:opacity .5s ease;font-family:'Poppins',sans-serif">
    <div style="position:relative;width:80px;height:80px">
        <div style="position:absolute;inset:0;border-radius:50%;border:4px solid rgba(255,255,255,0.1)"></div>
        <div style="position:absolute;inset:0;border-radius:50%;border:4px solid transparent;border-top-color:#C8A45C;border-right-color:#16423C;animation:preloaderSpin .8s linear infinite"></div>
        <div style="position:absolute;inset:8px;border-radius:50%;border:3px solid transparent;border-bottom-color:#C8A45C;border-left-color:#16423C;animation:preloaderSpin .6s linear infinite reverse"></div>
    </div>
    <div style="margin-top:24px;color:#C8A45C;font-size:14px;font-weight:500;letter-spacing:2px;text-transform:uppercase;animation:preloaderPulse 1.5s ease-in-out infinite">Memuat...</div>
</div>
<style>
@keyframes preloaderSpin { to { transform:rotate(360deg) } }
@keyframes preloaderPulse { 0%,100%{opacity:.4} 50%{opacity:1} }
</style>
<script>
(function(){
    var p = document.getElementById('page-preloader');
    if (sessionStorage.getItem('preloader_hydrated')) {
        sessionStorage.removeItem('preloader_hydrated');
        if (p && p.parentNode) p.parentNode.removeChild(p);
        return;
    }
    function hide(){ if(p){ p.style.opacity='0'; setTimeout(function(){ if(p&&p.parentNode) p.parentNode.removeChild(p); },500); } }
    if(document.readyState==='complete') hide();
    else window.addEventListener('load', hide);
    setTimeout(hide, 8000);
})();
</script>
