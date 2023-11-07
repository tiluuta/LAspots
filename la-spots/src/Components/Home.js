import {Outlet, Link} from "react-router-dom";

const Home = () => {
    return <html>
        <head>
            <title>LA Spots</title>
                <meta charSet="UTF-8"></meta>
        </head>
        <body>
        <div className="row">
            <div id="spotlight" className="item" style={{width:'34.5%', position:'relative'}}>
                <img className="frontpage-img" src={require("../Assets/LIES479-046.jpg")}></img>
                    <a className="location-tag" href="detail-spots.php">&#128205; The Wallflower, Venice</a>
            </div>

            <div className="item" style={{width:'65%'}}>
                <h1>LA Spots</h1>
                <h4 style={{width:'60%'}}>Experience the city of angels differently.
                    Find your favorite hidden gems that won’t pop up in a simple internet search.</h4>
                <div>
                    <button className="tan round-button"><Link to="/search">Find your spot</Link></button>
                </div>
                <br></br>
                    <div>
                        <button className="green round-button"><a href="random-spots.php">I'm feeling lucky</a></button>
                    </div>
            </div>
        </div>
        </body>
    </html>;
};

export default Home;
