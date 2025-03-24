import jsonfile from "jsonfile";
import moment from "moment";
import simpleGit from "simple-git";

const path = "./data.json";
const git = simpleGit();

function getRandomGap(min = 0, max = 4) {
  return Math.floor(Math.random() * (max - min + 1)) + min;
}

function getRandomCommitsPerDay(min = 1, max = 2) {
  return Math.floor(Math.random() * (max - min + 1)) + min;
}

async function run() {
  let currentDate = moment("2025-03-28", "YYYY-MM-DD");

  for (let i = 0; i < 56; i++) {
    const gap = getRandomGap(0, 4);
    currentDate = currentDate.subtract(gap, "days");

    const commitsToday = getRandomCommitsPerDay(1, 2);

    for (let j = 0; j < commitsToday; j++) {
      const commitTime = currentDate
        .clone()
        .hour(10 + j)
        .minute(Math.floor(Math.random() * 60));
      const date = commitTime.format();

      const data = {
        date,
        commitNumber: j + 1,
        totalCommitsToday: commitsToday,
      };

      await jsonfile.writeFile(path, data);
      await git.add([path]);
      await git.commit(`Commit ${j + 1} on ${date}`, undefined, {
        "--date": date,
      });

      console.log(`✅ Commit ${j + 1}/${commitsToday} on: ${date}`);
    }
  }
}

run().catch(console.error);
