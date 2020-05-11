import React from "react";
import ReactDOM from "react-dom";
import "../css/app.css";
import Navbar from "./components/Navbar";
import HomePage from "./pages/HomePage";
import { HashRouter, Switch, Route } from "react-router-dom";
import CustomersPage from "./pages/CustomersPage";
import InvoicesPage from "./pages/InvoicesPage";

function App() {
  return (
    <div className="App">
      <HashRouter>
        <Navbar />
        <main className="container pt-5">
          <Switch>
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
