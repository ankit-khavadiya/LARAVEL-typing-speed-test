<!-- Main Header -->
<header class="main-header">
    <div class="container">
        <nav class="navbar">
            <a class="navbar-brand" href="{{ route('typing-test') }}">
                <span class="brand-mark"><i class="fas fa-keyboard"></i></span>
                <span class="brand-text">Type<span>Rush</span></span>
            </a>

            <ul class="header-meta">
                <li><i class="fas fa-bolt"></i> Live word count</li>
                <li><i class="fas fa-bullseye"></i> Accuracy tracking</li>
                <li><i class="fas fa-stopwatch"></i> Timed runs</li>
            </ul>

            <button type="button" class="btn-shortcuts" data-bs-toggle="modal" data-bs-target="#shortcutsModal">
                <i class="fas fa-circle-question"></i>
                <span>How to play</span>
            </button>
        </nav>
    </div>
</header>
