<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Alhilmakw</title>
    <style type="text/css">
        div,
        p,
        a,
        li,
        td {
            -webkit-text-size-adjust: none;
        }

        html {
            width: 100%;
        }

        body {
            width: 100% !important;
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
            margin: 0;
            padding: 0;
        }

        img {
            outline: none;
            text-decoration: none;
            border: none;
            -ms-interpolation-mode: bicubic;
        }

        a img {
            border: none;
        }

        p {
            margin: 0px 0px !important;
        }

        table td {
            border-collapse: collapse;
        }

        table {
            border-collapse: collapse;
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }

        td[class=grngv] p {
            font-size: 13px;
        }

        table[class=sgsmal] tr,
        table[class=sgsmal] td {
            line-height: 12px;
        }

        @media only screen and (max-width: 645px) {
            table[class=devicewdt] {
                width: 445px !important;
            }

            td[class=logocvr] {
                clear: both;
                display: block;
                overflow: hidden;
                text-align: center;
                width: 100% !important;
            }

            td[class=prstyle] {
                float: left;
                text-align: left;
                width: auto !important;
            }

            td[class=adstyle] {
                float: right;
                width: auto !important;
            }

            table[class=insidefull] .fullwdth {
                display: block;
                overflow: hidden;
                width: 100% !important;
                text-align: center;
                border-bottom: 1px solid #dddddd;
            }

            table[class=insidefull] .fullwdth:last-child {
                border-bottom: none
            }

            div[class=stay_place] {
                width: 93% !important;
                padding: 10px !important;
                margin-bottom: 5px !important;
            }

            button[class=btns] {
                float: unset !important;
                margin-top: 0px !important;
            }

            div[class=menus] {
                font-size: 10px !important;
                font-weight: bold !important;
                width: 100% !important;
            }

            p[class=p_txt] {
                padding: 10px !important;
            }
        }

        @media only screen and (max-width: 480px) {
            table[class=devicewdt] {
                width: 290px !important;
            }

            div[class=stay_place] {
                width: 93% !important;
                padding: 10px !important;
                margin-bottom: 5px !important;
            }

            button[class=btns] {
                float: unset !important;
                margin-top: 0px !important;
            }

            div[class=menus] {
                font-size: 10px !important;
                font-weight: bold !important;
                width: 100% !important;
            }

            p[class=p_txt] {
                padding: 10px !important;
            }
        }

        a {
            color: #ff7c17;
        }
    </style>
</head>

<body>
    <table
        style="max-width:645px; margin:10px auto;border: 1px solid #dddddd; background:url({{url('uploads/giftcardimage/'.$image.'')}}) no-repeat ; background-size: 100% 100%;"
        class="devicewdt">
        <tr>
            <td style="padding:10px;">
                <table style="width:100%; color:#1f1f24; font-size:13px;font-family: arial,serif;line-height: 22px;margin-top:20px;">
                    <tr style="text-align: center;">
                        <td colspan="3" valign="bottom" style="padding-bottom:10px;"><img src="{{url('assets/img/logo.png')}}" style="width: 90px;">
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-bottom:10px;font-size:15px;color: #444444; ">
                            <div >
                                <p style="font-size: 35px;font-weight:700;padding-left: 10px; text-align: center; padding: 20px;color:#29a64a;">
                                    Dummy text</p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="padding-bottom:10px;font-size:15px;color: #444444;" class="grngv">
                            <p class="p_txt"
                                style="font-size: 16px; padding-bottom:10px; text-align: center; padding-left: 60px; padding-right: 60px;">
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                                has been the industry's standard dummy text ever since the 1500s, when an unknown
                                printer took a galley of type and scrambled it to make a type specimen book.</p>
            
                            <div class="stay_place"
                                style="padding: 20px;float: left;width: 600px;margin-bottom: 30px;">
                                <div >
                                    <p style="font-size: 35px; font-weight:700; padding-top:0px; padding-bottom:20px; text-align: center; color:#29a64a;">
                                        Dummy text</p>
                                    <p style="font-size: 25px; font-weight:700; padding-top:0px; padding-bottom:20px; text-align: center; color:#d9a25f;">
                                        {{$recipient_name}}</p>
                                </div>

                                <p class="p_txt"
                                    style="padding-bottom:10px;padding-top:25px; text-align: center; padding-left: 60px; padding-right: 60px; font-size: 25px;font-weight:700;line-height: 1; color:#b64704;">
                                    Lorem Ipsum is simply dummy text of the printing.
                                </p>

                                <p class="p_txt"
                                    style="padding-bottom:10px; text-align: center; padding-left: 60px; padding-right: 60px; font-size: 16px;">
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                    Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                                    unknown printer took a galley of type and scrambled it to make a type specimen
                                </p>

                                <p class="p_txt"
                                    style="padding-bottom:10px; text-align: center; padding-left: 60px; padding-right: 60px; font-size: 16px;">
                                     {{$sender_name}}</p>
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
