import { motion } from "framer-motion";
import { Trophy, BadgeCheck, Award } from "lucide-react";

const achievements = [
  {
    title: "Top Intern Award",
    description: "Recognized for outstanding performance during internship.",
    icon: <Trophy className="text-yellow-500 w-5 h-5" />,
    year: "2025",
  },
  {
    title: "Flutter Certified",
    description: "Completed Google Flutter Bootcamp with distinction.",
    icon: <BadgeCheck className="text-blue-500 w-5 h-5" />,
    year: "2024",
  },
  {
    title: "Hackathon Finalist",
    description: "Reached finals in national-level hackathon 2024.",
    icon: <Award className="text-purple-500 w-5 h-5" />,
    year: "2023",
  },
];

export default function AchievementsTimeline() {
  return (
    <section className="py-16 bg-muted">
      <div className="container mx-auto px-4">
        <h2 className="text-3xl font-bold text-center text-foreground mb-10">Achievements</h2>

        <div className="relative border-l-2 border-primary pl-6 space-y-12">
          {achievements.map((achieve, index) => (
            <motion.div
              key={index}
              initial={{ opacity: 0, x: -50 }}
              whileInView={{ opacity: 1, x: 0 }}
              viewport={{ once: true }}
              transition={{ duration: 0.5, delay: index * 0.2 }}
              className="relative"
            >
              <div className="absolute -left-3 top-1.5 bg-background border border-primary rounded-full p-2 shadow">
                {achieve.icon}
              </div>

              <div className="ml-6 bg-background rounded-xl shadow p-6">
                <h3 className="text-xl font-semibold text-foreground">{achieve.title}</h3>
                <span className="text-sm text-muted-foreground">{achieve.year}</span>
                <p className="mt-2 text-muted-foreground">{achieve.description}</p>
              </div>
            </motion.div>
          ))}
        </div>
      </div>
    </section>
  );
}
