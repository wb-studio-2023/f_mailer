<html>
    <head>
        <title>@yield('title')</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"/>
        <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
        <link rel="stylesheet" href="{{ mix('css/front/common.css') }}">
        <script src="{{ mix('js/front/pc/swiper.js') }}"></script>
    </head>
    <body>
        <form action="{{ route('member.regist.confirm') }}" method="POST">
            @csrf

            <header>
                <div class="header_image">
                    <img src="{{ mix('img/common/pc/header_test.png') }}" class="display">
                </div>
                    <table class="header_form">
                        <tr>
                            <td>
                                <input type="email" name="adress" placeholder="メールアドレス">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="password" name="password" placeholder="パスワード">
                            </td>
                        </tr>
                        <tr>
                            <td class="rule">
                                <input type="checkbox" name="rule">
                                <a href="">利用規約</a>に同意しますか？
                            </td>
                        </tr>
                        <tr>
                            <td class="button">
                                <input type="submit" value="登録">
                            </td>
                        </tr>
                    </table>
            </header>

            <main>
                <div id="" class="contents_inner">
                    <p class="text_contents">
                        今、あなたはメール配信システムを使いたいけど、
                    </p>
                    <div class="worries">
                        <ul>
                            <li>自分のサービスが<span class="red">マネタイズできるまで</span>お金かけたくない...</li>
                            <li>メーラーにさく<span class="red">お金が</span>もったいない...</li>
                            <li>無料メーラーは<span class="red">広告が</span>ついている...</li>
                            <li>無料だと<span class="red">速度が</span>...</li>
                            <li>メーラーは<span class="red">使い方が難しい</span>...</li>
                            <li><span class="red">到達してくれなきゃ</span>メーラーの意味がないんだけど...</li>
                        </ul>
                        <div class="image"><img src="{{ mix('img/common/pc/neko_nayami.png') }}"></div>
                    </div>
                    <p class="text_contents">
                        こんなお悩みを持っていませんか？<br>
                        もし<span class="fs_26">一つでも当てはまるなら、</span><br>
                        あなたにピッタリのサービスが実現しました。
                    </p>
                    <p class="text_contents">
                        その名も<br>
                        <span class="fs_26">無料メール配信サービス：「無料メールサーバー（仮）」</span>
                    </p>
                </div>

                <div id="" class="contents_inner">
                    <h2>「無料メールサーバー（仮）」が選ばれる5つの理由</h2>
                    <div class="selected_reason">
                        <div class="box">
                            <h3><span class="title_num">01</span>いくら使っても<span class="stand_out">永久無料</span></h3>
                            <p>
                                他サービスでフリープランを使っても、送信数に制限があったり、配信リスト数に制限があったり、日数に制限があったりと、何かと制限が付きますよね？<br>
                                しかし、「無料メールサーバー（仮）」はリスト数、配信数、日数に制限なく無料で使えます。
                            </p>
                        </div>
                        <div class="box">
                            <h3><span class="title_num">02</span>わずらわしい<span class="stand_out">広告の排除</span></h3>
                            <p>
                                こちらも他サービスのフリープランでありがちですが、メール本文の最初、もしくは最後に広告がついてしまうというものです。<br>
                                これでは、ライティングの常識としての「出口は1つ」というものに反してしまいます。もちろん、それではあなたがせっかく作成したメールがぼやけてしまいます。<br>
                                それを避けるために広告もつきません。
                            </p>
                        </div>
                        <div class="box">
                            <h3><span class="title_num">03</span>3システムを用いた<span class="stand_out">高い到達率</span></h3>
                            <p>
                                メールは送っただけでは意味はありません。あなたの作成したメールは相手に届いて読んでもらってこそのメールです。<br>
                                そのために独自の3システムを導入することにより、高い到達率を実現しました。
                            </p>
                        </div>
                        <div class="box">
                            <h3><span class="title_num">04</span>「1時間250万通」<span class="stand_out">高速大量配信</span></h3>
                            <p>
                                メールを送信していて、キャンペーンを打ち出したいときや、何か急ぎのメールを送信したい時など、素早く送信したいメールもありませんか？<br>
                                その素早さために独自のシステムにより「1時間250万通」の高速大量配信を実現しました。<br>
                            </p>
                        </div>
                        <div class="box">
                            <h3><span class="title_num">05</span>かんたんシンプルで、<span class="stand_out">充実のサポート</span>付き</h3>
                            <p>
                                メール配信システムに限らず、どんなものにおいても初めて使用する時などは結構慣れるまでに時間がかかるものです。<br>
                                せっかく使ってみたいと思ってくれたあなたが「良さ」を分かってもらう前に利用を断念してしまっては、本意ではありません。<br>
                                なので専門のサポートチームで充実のサポートをします。
                            </p>
                        </div>
                    </div>
                    <div class="">
                        この5つの理由で「無料メールサーバー（仮）」が選ばれています。
                    </div>
                </div>

                <div id="" class="contents_inner">
                    <h2>2つの大機能が追加</h2>
                    <div class="add_function">
                        <div class="text_area">
                            先ほど紹介した選ばれている5つの理由のほかに、<br>
                            あると嬉しい2つの機能の追加の予定をしています。<br>
                            その機能というのは・・・
                        </div>
                        <div class="function_area">
                            <div class="box">
                                <p>STEPメール（近日公開）</p>
                            </div>
                            <div class="box">
                                <p>HTMLメール（現在開発中）</p>
                            </div>
                        </div>
                        <div class="text_area">
                            メール配信サービスを使おうとしているあなたに説明は不要かと思うので省きますが、<br>
                            この2つの機能の実装を近日予定しています。<br>
                        </div>
                    </div>
                </div>

                <div id="" class="contents_inner">
                    <h2>利用者の声</h2>

                    <div class="voice">
                        <div class="swiper">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="box">
                                        <div class="title">ああああああああああああああああ</div>
                                        <p>
                                            ああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああ
                                        </p>
                                        <div class="personal_info">ああああああああああああああああ</div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="box">
                                        <div class="title">ああああああああああああああああ</div>
                                        <p>
                                            ああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああ
                                        </p>
                                        <div class="personal_info">ああああああああああああああああ</div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="box">
                                        <div class="title">ああああああああああああああああ</div>
                                        <p>
                                            ああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああ
                                        </p>
                                        <div class="personal_info">ああああああああああああああああ</div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="box">
                                        <div class="title">ああああああああああああああああ</div>
                                        <p>
                                            ああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああ
                                        </p>
                                        <div class="personal_info">ああああああああああああああああ</div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="box">
                                        <div class="title">ああああああああああああああああ</div>
                                        <p>
                                            ああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああ
                                        </p>
                                        <div class="personal_info">ああああああああああああああああ</div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="box">
                                        <div class="title">ああああああああああああああああ</div>
                                        <p>
                                            ああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああ
                                        </p>
                                        <div class="personal_info">ああああああああああああああああ</div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-pagination"></div>
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-button-next"></div>
                        </div>

                        <div class="voice_summarize">
                            <ul>
                                <li>
                                    あああああああああああああああああああああああああああああああああああああああああああ
                                </li>
                                <li>
                                    あああああああああああああああああああああああああああああああああああああああああああ
                                </li>
                                    あああああああああああああああああああああああああああああああああああああああああああ
                                <li>
                                    あああああああああああああああああああああああああああああああああああああああああああ
                                </li>
                                    あああああああああああああああああああああああああああああああああああああああああああ
                                <li>
                                    あああああああああああああああああああああああああああああああああああああああああああ
                                </li>
                                <li>
                                    あああああああああああああああああああああああああああああああああああああああああああ
                                </li>
                            </ul>
                            <div class="">
                                といったご意見をくださっているところを見ると、<br>
                                「無料メールサーバー（仮）」に満足してもらっているようで<br>
                                大変うれしく思っています。
                            </div>
                        </div>
                    </div>
                </div>

                <div id="" class="contents_inner">
                    <h2>満足度も99.7％</h2>
                    <div class="closing">
                        メールで最も大切なことは「到達率」です。
                        そもそも送っても届かないのでは意味がありません。
                        〇〇〇は、最新技術のIPウォームアップで
                        高い到達率を実現しています。
                        〇〇〇に乗り換え理由の第一位は、
                        「今のシステムが到達率が低いから」です。
                        そして到達率満足度も99.7％（当社調べ）と
                        高水準をマークしています。

                        数百の分散型配信をとり、
                        1時間に250万通の高速配信を
                        実現可能にしました。
                        お待たせすることなく、
                        そしてより多くのメール配信できます。

                        難しい説明が常識のメール配信システムですが、
                        〇〇〇は、余計な機能をできるだけ排除し、
                        ご利用者ガイドで具体的な操作がわかりますので、
                        安心してスタートできます。
                        また他社では有料版でしかつかないような
                        メールサポートも対応していますので、
                        安心して快適なメーラーライフを送れます。
                    </div>
                </div>

                <div id="" class="contents_inner">
                    <h2>よくある質問</h2>
                    <div class="closing">
                        メールで最も大切なことは「到達率」です。
                        そもそも送っても届かないのでは意味がありません。
                        〇〇〇は、最新技術のIPウォームアップで
                        高い到達率を実現しています。
                        〇〇〇に乗り換え理由の第一位は、
                        「今のシステムが到達率が低いから」です。
                        そして到達率満足度も99.7％（当社調べ）と
                        高水準をマークしています。


                        数百の分散型配信をとり、
                        1時間に250万通の高速配信を
                        実現可能にしました。
                        お待たせすることなく、
                        そしてより多くのメール配信できます。


                        難しい説明が常識のメール配信システムですが、
                        〇〇〇は、余計な機能をできるだけ排除し、
                        ご利用者ガイドで具体的な操作がわかりますので、
                        安心してスタートできます。
                        また他社では有料版でしかつかないような
                        メールサポートも対応していますので、
                        安心して快適なメーラーライフを送れます。
                    </div>
                </div>

            </main>

        </form>
        <footer>

        </footer>
    </body>
</html>    