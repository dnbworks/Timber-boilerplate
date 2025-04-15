import { run } from "./js/app";
import "./scss/styles.scss";

require.context('./img/jpg', true);
// require.context('jpg/', true);
// require.context('img/png/', true);

run();