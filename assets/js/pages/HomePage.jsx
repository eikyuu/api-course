import React, { Component } from "react";

const HomePage = (props) => {
  return (
    <div className="jumbotron">
      <h1 className="display-3">Bienvenue sur Shym</h1>
      <p className="lead">
        Cette application est realiser avec Symfony ApiPlatform et React, elle a
        pour but de gerer vos clients et vos factures.
      </p>
    </div>
  );
};

export default HomePage;
