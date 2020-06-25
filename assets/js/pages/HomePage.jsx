import React, { Component } from "react";

const HomePage = (props) => {
  return (
    <div className="jumbotron">
      <h1 className="display-3">Bienvenue sur Shym</h1>
      <p className="lead">
        Shym vous permet de gérer vos clients et leurs factures très simplement
        sur une interface minimaliste sécuriser et performante.
      </p>
      <p>Pour débuter, commencez par vous inscrire ! </p>
      <button className="btn btn-primary">Je m'inscris</button>
    </div>
  );
};

export default HomePage;
