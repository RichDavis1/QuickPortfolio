<div id="mobile-header">
    <div class="nav-wrap">
        <div class="nav-wrap">
            <a href="/">
                <div class="logo-wrap">
                    {{ $settings->getWebsiteName() }}
                </div>    
            </a>
            <button class="hamburger hamburger--spin" id="hamburger" data-status="closed" type="button">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
        </div>
    </div>
    <div id="mobile-nav" class="hidden">
        <a href="/projects" class="container-toggle">Projects</a>
        <div class="container-toggle" id="contact-trigger">Contact</div>
        @if(Auth::user() && Auth::user()->isAdmin())
            <a href="/admin" class="container-toggle">Admin</a>
        @endif       
        @if($settings->getGithubLink())
            <a href="{{ $settings->getGithubLink() }}" target="_blank" class="container-toggle">Github</a>
        @endif    
        @if($settings->getLinkedinLink())
            <a href="{{ $settings->getLinkedinLink() }}" target="_blank" class="container-toggle">LinkedIn</a>
        @endif                        
    </div>    
</div>