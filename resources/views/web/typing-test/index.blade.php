@extends('web.master')

`@section('title', 'Typing Speed Test - Count Your Words and Accuracy | TypeRush')

@section('page-content')
    <!-- Hero / Game Section -->
    <section class="game-section">
        <div class="glow glow-1"></div>
        <div class="glow glow-2"></div>

        <div class="container">
            <div class="game-intro" data-reveal>
                <span class="game-badge"><i class="fas fa-bolt"></i> Live speed tracking</span>
                <h1 class="game-title">How fast can you <span>really</span> type?</h1>
                <p class="game-text">
                    Start typing the text below &mdash; the timer begins on your first keystroke. Watch your
                    completed words, accuracy and errors update live, then see your full breakdown.
                </p>
            </div>

            <!-- Test Options -->
            <div class="test-options" data-reveal>
                <div class="option-group">
                    <span class="option-label"><i class="fas fa-stopwatch"></i> Duration</span>
                    <div class="option-chips" id="durationChips">
                        @foreach($durations as $item)
                            <button type="button" class="chip {{ $item == $duration ? 'active' : '' }}" data-duration="{{ $item }}">
                                {{ $item }}s
                            </button>
                        @endforeach
                    </div>
                </div>

                <div class="option-group">
                    <span class="option-label"><i class="fas fa-layer-group"></i> Difficulty</span>
                    <div class="option-chips" id="difficultyChips">
                        @foreach(array_keys($passages) as $level)
                            <button type="button" class="chip {{ $level == 'medium' ? 'active' : '' }}" data-difficulty="{{ $level }}">
                                {{ ucfirst($level) }}
                            </button>
                        @endforeach
                    </div>
                </div>

                <div class="option-group option-group-end">
                    <button type="button" class="btn-restart" id="restartBtn">
                        <i class="fas fa-rotate-right"></i>
                        <span>Restart</span>
                    </button>
                </div>
            </div>

            <!-- Live Stats -->
            <div class="stat-row" data-reveal>
                <div class="stat-card stat-time">
                    <span class="stat-icon"><i class="fas fa-clock"></i></span>
                    <div class="stat-body">
                        <span class="stat-value" id="statTime">{{ $duration }}</span>
                        <span class="stat-label">Seconds left</span>
                    </div>
                    <div class="stat-progress"><span id="timeProgress"></span></div>
                </div>

                <div class="stat-card stat-wpm">
                    <span class="stat-icon"><i class="fas fa-gauge-high"></i></span>
                    <div class="stat-body">
                        <span class="stat-value" id="statWpm">0</span>
                        <span class="stat-label">Words completed</span>
                    </div>
                </div>

                <div class="stat-card stat-accuracy">
                    <span class="stat-icon"><i class="fas fa-bullseye"></i></span>
                    <div class="stat-body">
                        <span class="stat-value" id="statAccuracy">100<small>%</small></span>
                        <span class="stat-label">Accuracy</span>
                    </div>
                </div>

                <div class="stat-card stat-errors">
                    <span class="stat-icon"><i class="fas fa-triangle-exclamation"></i></span>
                    <div class="stat-body">
                        <span class="stat-value" id="statErrors">0</span>
                        <span class="stat-label">Errors</span>
                    </div>
                </div>
            </div>

            <!-- Typing Area -->
            <div class="typing-shell" id="typingShell" data-reveal>
                <div class="typing-head">
                    <span class="typing-status" id="typingStatus">
                        <i class="fas fa-circle-play"></i> Click the text and start typing
                    </span>
                    <span class="typing-hint">
                        <kbd>Tab</kbd> restart &nbsp;·&nbsp; <kbd>Esc</kbd> reset
                    </span>
                </div>

                <div class="typing-viewport" id="typingViewport">
                    <div class="typing-text" id="typingText"></div>
                    <span class="caret" id="caret"></span>
                </div>

                <div class="typing-overlay" id="typingOverlay">
                    <i class="fas fa-hand-pointer"></i>
                    <span id="typingOverlayText">Click here to focus and start the test</span>
                </div>

                <input type="text" id="typingInput" class="typing-input" autocomplete="off" autocorrect="off"
                       autocapitalize="off" spellcheck="false" aria-label="Typing test input">

                <!-- Result Card -->
                <div class="result-card" id="resultCard">
                    <div class="result-inner">
                        <span class="result-tag"><i class="fas fa-flag-checkered"></i> Test complete</span>
                        <h2 class="result-headline" id="resultHeadline">Nice run!</h2>

                        <div class="result-hero">
                            <div class="result-wpm">
                                <span class="result-wpm-value" id="resultWpm">0</span>
                                <span class="result-wpm-label">Words</span>
                            </div>
                            <div class="result-ring" id="resultRing">
                                <span id="resultAccuracy">100%</span>
                                <small>Accuracy</small>
                            </div>
                        </div>

                        <ul class="result-grid">
                            <li>
                                <span class="result-grid-label">Words attempted</span>
                                <span class="result-grid-value" id="resultRaw">0</span>
                            </li>
                            <li>
                                <span class="result-grid-label">Characters</span>
                                <span class="result-grid-value" id="resultChars">0</span>
                            </li>
                            <li>
                                <span class="result-grid-label">Correct</span>
                                <span class="result-grid-value text-correct" id="resultCorrect">0</span>
                            </li>
                            <li>
                                <span class="result-grid-label">Errors</span>
                                <span class="result-grid-value text-wrong" id="resultWrong">0</span>
                            </li>
                            <li>
                                <span class="result-grid-label">Time</span>
                                <span class="result-grid-value" id="resultTime">0s</span>
                            </li>
                            <li>
                                <span class="result-grid-label">Personal best</span>
                                <span class="result-grid-value" id="resultBest">0</span>
                            </li>
                        </ul>

                        <div class="result-actions">
                            <button type="button" class="btn-primary-glow" id="tryAgainBtn">
                                <i class="fas fa-rotate-right"></i> Try again
                            </button>
                            <button type="button" class="btn-ghost" id="newTextBtn">
                                <i class="fas fa-shuffle"></i> New text
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('model')
    <!-- How to play modal -->
    <div class="modal fade shortcuts-modal" id="shortcutsModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-circle-question me-2"></i>How the test works</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul class="how-list">
                        <li><i class="fas fa-1"></i> Pick a duration and a difficulty, then click the text block.</li>
                        <li><i class="fas fa-2"></i> The timer starts the moment you press your first key.</li>
                        <li><i class="fas fa-3"></i> Correct letters brighten, mistakes turn red &mdash; backspace to fix them.</li>
                        <li><i class="fas fa-4"></i> Every word you finish without a mistake adds one to your word count &mdash; capital letters and punctuation have to match too.</li>
                        <li><i class="fas fa-5"></i> Press <kbd>Tab</kbd> any time to restart with fresh text.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('webJs')
    <script>
        $(function () {

            let passages = @json($passages);

            // elements
            let $typingShell   = $('#typingShell');
            let typingText     = document.getElementById('typingText');
            let typingViewport = document.getElementById('typingViewport');
            let caret          = document.getElementById('caret');
            let typingInput    = document.getElementById('typingInput');

            // test state, rebuilt from scratch on every restart
            let state = {
                duration:   {{ $duration }},
                difficulty: 'medium',
                target:     '',
                spans:      [],
                words:      [],
                typed:      '',
                keystrokes: 0,
                startedAt:  null,
                timeLeft:   {{ $duration }},
                timerId:    null,
                liveId:     null,
                running:    false,
                finished:   false,
                metrics:    null
            };

            // ---------------------------------------------------------------
            // text generation
            // ---------------------------------------------------------------

            // passages in a random order, stitched together until there is comfortably
            // more text than even a fast typist can finish before the clock runs out
            function buildTarget() {
                let pool = (passages[state.difficulty] || []).slice();

                if (!pool.length) {
                    return '';
                }

                // roughly 15 characters a second is well clear of a 100+ word a minute pace
                let needed = Math.max(400, state.duration * 15);
                let text   = '';

                while (text.length < needed) {
                    shuffle(pool);

                    for (let i = 0; i < pool.length && text.length < needed; i++) {
                        text += (text ? ' ' : '') + pool[i];
                    }
                }

                return text;
            }

            // Fisher-Yates, so every passage is used once before any of them repeats
            function shuffle(items) {
                for (let i = items.length - 1; i > 0; i--) {
                    let j = Math.floor(Math.random() * (i + 1));
                    let swap = items[i];
                    items[i] = items[j];
                    items[j] = swap;
                }

                return items;
            }

            // one span per character, grouped per word so lines never break mid word
            function renderTarget() {
                typingText.innerHTML = '';
                state.spans = [];

                let words = state.target.split(' ');
                let cursor = 0;

                state.words = [];

                words.forEach(function (word, index) {
                    // the span of target indexes this word occupies, used to tell when
                    // the player has finished it
                    state.words.push({ start: cursor, end: cursor + word.length - 1 });
                    cursor += word.length + 1;

                    let wordEl = document.createElement('span');
                    wordEl.className = 'word';

                    let chars = word.split('');

                    if (index < words.length - 1) {
                        chars.push(' ');
                    }

                    chars.forEach(function (char) {
                        let charEl = document.createElement('span');
                        charEl.className = 'char';
                        charEl.textContent = char;
                        wordEl.appendChild(charEl);
                        state.spans.push(charEl);
                    });

                    typingText.appendChild(wordEl);
                });

                typingText.appendChild(caret);
                typingText.style.transform = 'translateY(0px)';
                state.metrics = null;
            }

            // ---------------------------------------------------------------
            // painting
            // ---------------------------------------------------------------

            // repaint only the characters that can have changed since the last keystroke
            function paintChars(from, to) {
                for (let i = from; i <= to; i++) {
                    let span = state.spans[i];

                    if (!span) {
                        continue;
                    }

                    span.classList.remove('is-correct', 'is-wrong');

                    if (i < state.typed.length) {
                        span.classList.add(state.typed[i] === state.target[i] ? 'is-correct' : 'is-wrong');
                    }
                }
            }

            // the line step is measured from the rendered text rather than assumed from
            // the css, so wrapping stays correct at any font size or viewport width
            function lineMetrics() {
                if (state.metrics) {
                    return state.metrics;
                }

                let first = state.spans[0];

                if (!first) {
                    return { base: 0, step: 0 };
                }

                let base = first.offsetTop;
                let step = 0;

                for (let i = 1; i < state.spans.length; i++) {
                    if (state.spans[i].offsetTop !== base) {
                        step = state.spans[i].offsetTop - base;
                        break;
                    }
                }

                if (step <= 0) {
                    step = Math.round(first.offsetHeight * 1.6);
                }

                state.metrics = { base: base, step: step };

                return state.metrics;
            }

            // caret sits on the next character to type and drags the text up line by line,
            // keeping the active line on the second row of the window
            function moveCaret() {
                let index = Math.min(state.typed.length, state.spans.length - 1);
                let span  = state.spans[index];

                if (!span) {
                    return;
                }

                let atEnd   = state.typed.length >= state.spans.length;
                let metrics = lineMetrics();
                let line    = metrics.step > 0 ? Math.round((span.offsetTop - metrics.base) / metrics.step) : 0;
                let offset  = Math.max(0, (line - 1) * metrics.step);

                typingText.style.transform = 'translateY(-' + offset + 'px)';
                caret.style.top  = span.offsetTop + 'px';
                caret.style.left = (atEnd ? span.offsetLeft + span.offsetWidth : span.offsetLeft) + 'px';
                caret.style.height = span.offsetHeight + 'px';
            }

            // ---------------------------------------------------------------
            // stats
            // ---------------------------------------------------------------

            function correctChars() {
                let correct = 0;

                for (let i = 0; i < state.typed.length; i++) {
                    if (state.typed[i] === state.target[i]) {
                        correct++;
                    }
                }

                return correct;
            }

            function elapsedSeconds() {
                if (!state.startedAt) {
                    return 0;
                }

                // a whole run finished inside the first second would divide by almost
                // nothing, so the pace is always judged over at least one second
                return Math.max(1, (Date.now() - state.startedAt) / 1000);
            }

            // a word counts once the player has typed right through it — past the space
            // that follows it, or to the end of the text for the final word. `done` is
            // every word finished, `correct` only the ones with no mistyped character,
            // and `wrong` the mistyped characters inside them. A word still being typed
            // is not judged at all, so a slip fixed before the space costs nothing.
            function countWords() {
                let done    = 0;
                let correct = 0;
                let wrong   = 0;
                let typed   = state.typed;
                let last    = state.words.length - 1;

                for (let w = 0; w <= last; w++) {
                    let word    = state.words[w];
                    let isLast  = w === last;
                    // a finished word needs its trailing space typed too, except the last
                    let through = isLast ? word.end : word.end + 1;

                    if (typed.length <= through) {
                        break;
                    }

                    done++;

                    let slips = 0;

                    for (let i = word.start; i <= through; i++) {
                        if (typed[i] !== state.target[i]) {
                            slips++;
                        }
                    }

                    if (slips === 0) {
                        correct++;
                    }

                    wrong += slips;
                }

                return { done: done, correct: correct, wrong: wrong };
            }

            function currentWords() {
                return countWords().correct;
            }

            function currentErrors() {
                return countWords().wrong;
            }

            function currentAccuracy() {
                if (state.keystrokes === 0) {
                    return 100;
                }

                let value = ((state.keystrokes - currentErrors()) / state.keystrokes) * 100;

                // floored, so a run with any mistake never reads as a clean 100%
                return Math.max(0, Math.floor(value));
            }

            function paintStats() {
                $('#statWpm').text(currentWords());
                $('#statAccuracy').html(currentAccuracy() + '<small>%</small>');
                $('#statErrors').text(currentErrors());
                $('#statTime').text(state.timeLeft);
                $('#timeProgress').css('width', (state.timeLeft / state.duration) * 100 + '%');
            }

            // ---------------------------------------------------------------
            // clock
            // ---------------------------------------------------------------

            function startRun() {
                state.running   = true;
                state.startedAt = Date.now();

                $typingShell.addClass('is-running');
                $('#typingStatus').html('<i class="fas fa-circle-dot"></i> Test running &mdash; keep going');

                state.timerId = setInterval(function () {
                    state.timeLeft--;

                    if (state.timeLeft <= 0) {
                        state.timeLeft = 0;
                        paintStats();
                        finishRun();
                        return;
                    }

                    $('#statTime').text(state.timeLeft);
                    $('#timeProgress').css('width', (state.timeLeft / state.duration) * 100 + '%');

                    if (state.timeLeft <= 5) {
                        $('.stat-time').addClass('is-urgent');
                    }
                }, 1000);

                // the word count and accuracy should feel live, not once a second
                state.liveId = setInterval(paintStats, 200);
            }

            function stopClocks() {
                clearInterval(state.timerId);
                clearInterval(state.liveId);
                state.timerId = null;
                state.liveId  = null;
            }

            // ---------------------------------------------------------------
            // finish
            // ---------------------------------------------------------------

            function bestKey() {
                return 'typerush_best_words_' + state.duration + '_' + state.difficulty;
            }

            function readBest() {
                try {
                    return parseInt(localStorage.getItem(bestKey()), 10) || 0;
                } catch (e) {
                    return 0;
                }
            }

            function writeBest(wpm) {
                try {
                    localStorage.setItem(bestKey(), wpm);
                } catch (e) {
                    // storage can be blocked, the run itself still works
                }
            }

            // the word count alone says nothing without the test length, so the praise is
            // judged on the pace it works out to
            function headlineFor(words, seconds, accuracy) {
                let wpm = seconds > 0 ? (words / (seconds / 60)) : 0;

                if (accuracy < 80) {
                    return 'Slow down a little &mdash; accuracy first';
                }

                if (wpm >= 80) {
                    return 'Outstanding speed!';
                }

                if (wpm >= 60) {
                    return 'Seriously quick fingers!';
                }

                if (wpm >= 40) {
                    return 'Solid run &mdash; above average';
                }

                return 'Good start &mdash; keep practising';
            }

            function finishRun() {
                if (state.finished) {
                    return;
                }

                stopClocks();

                state.finished = true;
                state.running  = false;

                // the clock can overshoot the duration by a tick, so the final rates are
                // measured over the test length the player actually signed up for
                let seconds  = state.startedAt ? Math.min(elapsedSeconds(), state.duration) : 0;
                let correct  = correctChars();
                let tally    = countWords();
                let wpm      = tally.correct;
                let raw      = tally.done;
                let accuracy = currentAccuracy();
                let best     = readBest();

                if (wpm > best) {
                    best = wpm;
                    writeBest(wpm);
                    $('#resultBest').addClass('is-record');
                } else {
                    $('#resultBest').removeClass('is-record');
                }

                $('#resultHeadline').html(headlineFor(wpm, seconds, accuracy));
                $('#resultWpm').text(wpm);
                $('#resultAccuracy').text(accuracy + '%');
                $('#resultRaw').text(raw);
                $('#resultChars').text(state.typed.length);
                $('#resultCorrect').text(correct);
                $('#resultWrong').text(tally.wrong);
                $('#resultTime').text(Math.round(seconds) + 's');
                $('#resultBest').text(best);
                $('#resultRing').css('--ring-value', accuracy);

                $('#typingStatus').html('<i class="fas fa-flag-checkered"></i> Finished &mdash; review your result');
                $typingShell.removeClass('is-running').addClass('is-finished');
                typingInput.blur();

                // count the final numbers up so the card lands with some life
                countUp($('#resultWpm'), wpm);
            }

            function countUp($el, value) {
                let steps = 24;
                let step  = 0;

                let id = setInterval(function () {
                    step++;
                    $el.text(Math.round((value / steps) * step));

                    if (step >= steps) {
                        clearInterval(id);
                        $el.text(value);
                    }
                }, 22);
            }

            // ---------------------------------------------------------------
            // reset
            // ---------------------------------------------------------------

            function resetRun(freshText) {
                stopClocks();

                state.typed      = '';
                state.keystrokes = 0;
                state.startedAt  = null;
                state.timeLeft   = state.duration;
                state.running    = false;
                state.finished   = false;

                if (freshText || !state.target) {
                    state.target = buildTarget();
                }

                typingInput.value = '';
                typingInput.setAttribute('maxlength', state.target.length);

                renderTarget();
                moveCaret();

                $typingShell.removeClass('is-running is-finished');
                $('.stat-time').removeClass('is-urgent');
                $('#typingStatus').html('<i class="fas fa-circle-play"></i> Click the text and start typing');
                $('#statWpm').text(0);
                $('#statAccuracy').html('100<small>%</small>');
                $('#statErrors').text(0);
                $('#statTime').text(state.timeLeft);
                $('#timeProgress').css('width', '100%');
            }

            // ---------------------------------------------------------------
            // typing
            // ---------------------------------------------------------------

            // reading the input value handles physical keyboards, mobile keyboards and
            // backspace the same way, so there is one source of truth for what was typed
            $(typingInput).on('input', function () {
                if (state.finished) {
                    this.value = state.typed;
                    return;
                }

                let typed   = this.value;
                let previous = state.typed;

                if (!state.running && typed.length > 0) {
                    startRun();
                }

                // first position where the two strings differ, so only that tail repaints
                let diff = 0;
                let min  = Math.min(previous.length, typed.length);

                while (diff < min && previous[diff] === typed[diff]) {
                    diff++;
                }

                // every newly entered character counts as a keystroke; whether it was
                // right is judged later, when the word is committed with a space
                state.keystrokes += typed.length - diff;

                state.typed = typed;

                paintChars(diff, Math.max(previous.length, typed.length));
                moveCaret();
                paintStats();

                if (typed.length >= state.target.length) {
                    finishRun();
                }
            });

            $(typingInput).on('focus', function () {
                $typingShell.addClass('is-focused');
            }).on('blur', function () {
                $typingShell.removeClass('is-focused');

                // the clock keeps running, so losing focus mid test needs its own prompt
                $('#typingOverlayText').text(state.running
                    ? 'Click to carry on typing — the clock is still running'
                    : 'Click here to focus and start the test');
            });

            // clicking anywhere on the block puts the cursor back where it belongs
            $typingShell.on('click', function (e) {
                if ($(e.target).closest('.result-card').length) {
                    return;
                }

                typingInput.focus();
            });

            // ---------------------------------------------------------------
            // controls
            // ---------------------------------------------------------------

            $('#durationChips').on('click', '.chip', function () {
                $('#durationChips .chip').removeClass('active');
                $(this).addClass('active');

                state.duration = parseInt($(this).data('duration'), 10);
                resetRun(true);
                typingInput.focus();
            });

            $('#difficultyChips').on('click', '.chip', function () {
                $('#difficultyChips .chip').removeClass('active');
                $(this).addClass('active');

                state.difficulty = $(this).data('difficulty');
                resetRun(true);
                typingInput.focus();
            });

            $('#restartBtn, #newTextBtn').on('click', function () {
                resetRun(true);
                typingInput.focus();
            });

            $('#tryAgainBtn').on('click', function () {
                resetRun(false);
                typingInput.focus();
            });

            // Tab restarts with new text, Esc resets the same text
            $(document).on('keydown', function (e) {
                if (e.key === 'Tab') {
                    e.preventDefault();
                    resetRun(true);
                    typingInput.focus();
                }

                if (e.key === 'Escape') {
                    e.preventDefault();
                    resetRun(false);
                    typingInput.blur();
                }
            });

            // the caret and line offsets are measured, so they need recalculating on resize
            let resizeId = null;

            $(window).on('resize', function () {
                clearTimeout(resizeId);
                resizeId = setTimeout(function () {
                    state.metrics = null;
                    moveCaret();
                }, 120);
            });

            resetRun(true);
        });
    </script>
@endsection
