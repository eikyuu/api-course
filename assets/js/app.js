import React from "react";
import ReactDOM from "react-dom";
import "../css/app.css";
import Navbar from "./components/Navbar";
import HomePage from "./pages/HomePage";
import { HashRouter, Switch, Route } from "react-router-dom";
import CustomersPage from "./pages/CustomersPage";
import InvoicesPage from "./pages/InvoicesPage";
import LoginPage from "./pages/LoginPage";

function App() {
  return (
    <div className="App">
      <HashRouter>
        <Navbar />
        <main className="container pt-5">
          <Switch>
            <Route path="/login" component={LoginPage} />
            <Route path="/invoices" component={InvoicesPage} />
            <Route path="/customers" component={CustomersPage} />
            <Route path="/" component={HomePage} />
          </Switch>
        </main>
      </HashRouter>
    </div>
  );
}

ReactDOM.render(<App />, document.querySelector("#app"));
