@extends('layouts.mainCentered')
@section('Content')
    <style>
        .boxed {
            background-color: var(--darkbg);
            color: #ffffff;
            height: 40%;
        }


        
        .flexClass{
            flex: 0 0 97.5%;
            margin:10px 1.25%;
            max-width:100%;
        }
        

        @media only screen and (min-width: 1250px) {
            .flexClass{
                flex: 0 0 47.5%;
                margin:10px 1.25%;
                max-width:50%;
            }
        }
        @media only screen and (min-width: 1500px) {
            .flexClass{
                flex: 0 0 21.5%;
                margin:0 1.25%;
            }
        }

        .containerClass{
            display: flex;
            flex-wrap: wrap;
            max-width:100%;
            margin-left: auto;
            margin-right:auto;
        }

    </style>
    <div class="containerClass">
        <div class='boxed flexClass'>
            <div class="text-block">
                <h4>Email</h4>
                <p>kais.salem@bcu.mail.ac.uk. This email can be used to message me directly in case you have any
                    problems
                    with the website. You can use it if you would like ot offer suggestions or would like to point out a
                    bug
                    or
                    any errors that you can find within out website. We are always looking for some good crisisism so
                    that
                    we
                    are able to imporve at all times.</p>
            </div>
        </div>
        <div class='boxed flexClass'>
            <div class="text-block">
                <h4>Number</h4>
                <p>605–475–6962. This number can be used to contact the help desk who can help you if you are having any
                    issues
                    navigating the website. You can also use this for queries that you have about any games or consoles.
                    this
                    this line can also be used to discuss sales options for the service as well as cancelation of the
                    service
                    by speaking with our support team
                    Any issues can also be reported at my GitHub at https://github.com/ka15jat/care4you/issues
                </p>
            </div>
        </div>
        <div class='boxed flexClass'>
            <div class="text-block">
                <h4>Mail</h4>
                <p>Millenium Point (Curzon Street, B4 7XG). This address can be used to send any time of mail that you want
                    to
                    send
                    to
                    use. You can use it to voice your opinion and tell us how we could imporve our buisness. You can
                    also
                    use
                    this mail as a return adress </p>
            </div>
        </div>
        <div class='boxed flexClass'>
            <div class="text-block">
                <h4>Cookies</h4>
                <p>An HTTP cookie (also called web cookie, Internet cookie, browser cookie, or simply cookie) is a small
                    piece
                    of data sent from a website and stored on the user's computer by the user's web browser while the
                    user
                    is
                    browsing.Cookies are most commonly used to track website activity. When you visit some sites, the
                    server
                    gives you a cookie that acts as your identification card. Upon each return visit to that site, your
                    browser
                    passes that cookie back to the server.</p>
            </div>
        </div>
    </div>
@endsection
