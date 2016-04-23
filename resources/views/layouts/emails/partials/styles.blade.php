<style>
    body, .main-wrap {
        font-family: 'Avenir Next', 'PingFang SC', 'Microsoft Yahei', Arial, sans-serif;
        font-weight: 400;
        font-size: 18px;
        background: linear-gradient(to right, rgb(57, 82, 124), rgb(61, 99, 145));
        padding: 0;
        margin: 0;
        color: #fff;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }
    .main-wrap {
        width: 100%;
        height: 100%;
        background: linear-gradient(to right, rgb(57, 82, 124), rgb(61, 99, 145));
    }
    #wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        position: relative;
        padding: 0;
        margin: 0;
    }
    .header {
        margin: 1.5em 0 0;
    }
    .logo {
        border-radius: 50%;
        max-width: 150px;
        margin: 1em;
        box-shadow: 0 0 8px rgba(0,0,0, 0.65);
    }
    .section {
        background: linear-gradient(to bottom, rgba(25, 5, 15, 0.3), rgba(5, 5, 5, 0.25));
        max-width: 850px;
        min-width: 220px;
        padding: 4em 2.8em;
        box-shadow: 0 0 7px rgba(200,20,10, 0.35);
        margin: .5em 5em;
        border-radius: 12px;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }
    .hello {
        display: flex;
        justify-content: center;
        align-items: center;
        position: relative;
        margin-bottom: 2.5em;
        width: 100%;
    }
    .hello span {
        flex: 5;
        color: #c3d9b3;
        font-size: 1.58em;
        font-weight: 600;
        text-align: left;
    }
    .hello .avatar {
        flex: 1;
        max-width: 130px;
    }
    .hello .avatar img {
        width: 100%;
        display: block;
        border-radius: 50%;
    }
    .hello:after {
        content: '';
        background: #646464;
        width: 95%;
        display: block;
        height: 1px;
        position: absolute;
        bottom: 0;
        left: 2.5%;
        margin-bottom: -0.8em;
    }
    .footer {
        margin: 0 0 2.5em;
        text-align: center;
    }
    .footer a {
        font-size: .75em;
    }
    .powered {
        font-weight: 500 !important;
        color: #ee2 !important;
        font-size: 1.5em !important;
    }
    .row, .full {
        display: flex;
        justify-content: center;
        align-items: center;
        margin: .8em 0;
    }
    .full {
        flex-direction: column;
    }
    a {
        color: #ffad2d;
        font-size: .9em;
        text-decoration: none;
    }
    a:hover {
        color: #fff;
        text-decoration: underline;
    }
    small {
        font-size: .8em;
    }
    ul {
        list-style: none;
        margin: .5em 0;
        padding: 0;
    }
    li {
        display: inline;
    }
    li:after {
        content: '-';
        margin: 0 .5em;
        color: rgba(255,255,255, 0.65);
    }
    li:last-of-type:after {
        content: '';
        margin: 0;
    }
    h1,h2,h3,h4,h5,h6,p,small {
        width: 100%;
        color: #fff;
    }
    .left {
        text-align: left;
    }
    .right {
        text-align: right;
    }
    .no-reply {
        color: #bbbbbb;
        text-align: center;
    }
    @media (min-width: 250px) and (max-width: 600px) {
        h1 {
            font-size: 1.8em;
        }
        h2 {
            font-size: 1.5em;
        }
        h3 {
            font-size: 1.05em;
        }
        h4 {
            font-size: .9em;
        }
        p {
            font-size: .8em;
        }
        .hello span {
            font-size: 1.2em;
            width: 65%;
        }
        .hello .avatar {
            display: inline-block;
            width: calc(35% - 10px);
        }
    }
</style>