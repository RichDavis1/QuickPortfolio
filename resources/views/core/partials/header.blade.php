<div id="desktop-header">
    <div class="nav-wrap">
        <a href="/">
            <div class="logo-wrap" id="site-logo">
                {{ $settings->getWebsiteName() }}
            </div>    
        </a>
        <div class="mid-nav-bar">
            <a href="/projects" class="container-toggle">Projects</a>
            <div class="container-toggle" id="contact-trigger">Contact</div>
            @if(Auth::user() && Auth::user()->isAdmin())
                <a href="/admin" class="container-toggle">Admin</a>
            @endif        
        </div>
        <div class="fw" id="head-links">
            <a href="{{ $settings->getGithubLink() }}" id="head-ghl" class="mrl" target="_blank">
                <div class="header-icon github-grey"></div>
            </a>
            @if($settings->getLinkedinLink())
                <a href="{{ $settings->getLinkedinLink() }}" id="head-ll" target="_blank">
                    <div class="header-icon linkedin-grey"></div>
                </a>
            @endif
        </div>        
    </div>
</div>

