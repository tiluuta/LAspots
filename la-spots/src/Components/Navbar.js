import React from "react";
import '../App.css';
import {Outlet, Link} from "react-router-dom";

export default function Navbar(){
    return(
        <>
            <nav className="navbar">
                <Link to="/" className="logo">&nbsp;</Link>
                <Link to="/search">Search</Link>
                <Link to="/login" className="profile green">&nbsp;</Link>
            </nav>

            <Outlet />
        </>
    );
}